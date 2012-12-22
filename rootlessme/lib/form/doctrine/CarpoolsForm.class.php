<?php

/**
 * Carpools form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CarpoolsForm extends BaseCarpoolsForm
{
    /**
     * Configures the form
     */
    public function configure()
    {
         // Get the seat object associated with this form
        $ride = $this->getObject();
        
        // Routes are always created new. It is too difficult to update them for
        // now
        $newRoute = new Routes();
        
        // Create the embedded route form
        $route_form = new RoutesForm($newRoute);
        
        // Override the label for a few select fields in the route form
        $route_form->widgetSchema->setLabel('origin', 'Origin Location');
        $route_form->widgetSchema->setLabel('destination', 'Destination Location');
        
        // Update the default locations to match the existing route if it 
        // exists (this is not a new seat)
        if(!$this->isNew())
        {
            $route_form->setDefault('origin', $ride->getRoutes()->getOriginAddress());
            $route_form->setDefault('destination', $ride->getRoutes()->getDestinationAddress());
        }
        $this->embedForm('route', $route_form);

        // Change the vehicle list to only include the user's vehicles
        $personId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
        $this->setWidget('vehicle_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Vehicles'),
            'add_empty' => false,
            'query' => Doctrine::getTable('Vehicles')->getQueryForPerson($personId)
                )));
        // Change the start date and time widgets to be  textboxs for the
        // date and time picker. The default date validator will still work
        $this->setWidget('start_date',new sfWidgetFormInputDateText());
        $this->setWidget('start_time',new sfWidgetFormInputText());
        
        $this->widgetSchema->setLabel('seats_available', 'Seats Available');
        $this->widgetSchema->setLabel('start_date', 'Start Date');
        $this->widgetSchema->setLabel('start_time', 'Start Time');
        $this->widgetSchema->setLabel('asking_price', 'Asking Price (per seat) <span class="dollar-sign">$</span>');

        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'carpool_id',
            'route',
            'vehicle_id',
            'seats_available',
            'start_date',
            'start_time',
            'asking_price',
            'description'));



    }
    
    /**
     * Override for the doSave
     * @param Doctrine_Connection $con The connection to the database
     */
    public function doSave($con = null) 
    {
        // Get the original route id
        $routeId = $this->values['route']['route_id'];
        $routeChanged = false;
        
        // Only create a route if there is route data, because
        // this means the route is new or has been changed
        if ($this->values['route']['route_data'] != '')
        {
            // Saving the embedded forms is now first
            $embeddedRouteForm = $this->getEmbeddedForm('route');
            unset($embeddedRouteForm[RoutesForm::$CSRFFieldName]);
            $taintedValues = null;
            if(array_key_exists('route', $this->taintedValues))
            {
                $taintedValues = $this->taintedValues['route'];
            }
            $taintedFiles = null;
            if(array_key_exists('route', $this->taintedFiles))
            {
                $taintedFiles = $this->taintedFiles['route'];
            }
            $embeddedRouteForm->bind($taintedValues,$taintedFiles);
            $updatedRoute = $embeddedRouteForm->save();
            
            // Update the route in this carpool's object for route and solo route
            $updatedRouteId = $updatedRoute->getRouteId();
            $this->getObject()->setRouteId($updatedRouteId);
            $this->getObject()->setSoloRouteId($updatedRouteId);
//            $this->getObject()->setRoutes($updatedRoute);
//            $this->getObject()->setRoutes3($updatedRoute);
            $routeId = $updatedRoute->getRouteId();
            
            $routeChanged = true;
        }
                
        // Update the route id of the seat if the route has changed to make 
        // sure it does not get overwritten
        if ($routeChanged)
        {
            $this->values['route_id'] = $routeId;
            $this->values['solo_route_id'] = $routeId;
            $this->values['route']['route_id'] = $routeId;
        }
        
        // The driver should be the user who is logged in
        $this->values['driver_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
        
        $this->updateObject();
        $this->getObject()->save($con);
    }

}
