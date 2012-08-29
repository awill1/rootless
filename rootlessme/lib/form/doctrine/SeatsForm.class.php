<?php

/**
 * Seats form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeatsForm extends BaseSeatsForm
{
    /**
     * Configures the form, overridding the base form.
     */
    public function configure()
    {
        // Get the seat object associated with this form
        $seat = $this->getObject();
        
        // Routes are always created new. It is too difficult to update them for
        // now
        $newRoute = new Routes();
        
        // Create the embedded seat form
        $route_form = new RoutesForm($newRoute);
        
        // Override the label for a few select fields in the route form
        $route_form->widgetSchema->setLabel('origin', 'Pickup Location');
        $route_form->widgetSchema->setLabel('destination', 'Dropoff Location');
        
        // Update the default locations to match the existing route if it 
        // exists (this is not a new seat)
        if(!$this->isNew())
        {
            $route_form->setDefault('origin', $seat->getRoutes()->getOriginAddress());
            $route_form->setDefault('destination', $seat->getRoutes()->getDestinationAddress());
        }
        $this->embedForm('route', $route_form);

        // Change the pickup date and time widgets to be textboxs for the
        // date and time picker. The default date and time validators will
        // still work
        $this->setWidget('pickup_date',new sfWidgetFormInputText());
        $this->setWidget('pickup_time',new sfWidgetFormInputText());

        // Create the carpool and passenger choices, allowing the empty option
        $this->setWidget('carpool_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 
                                                                           'add_empty' => true,
                                                                           'table_method' => 'getMyCarpools')));
        $this->setWidget('passenger_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'),
                                                                             'add_empty' => true,
                                                                             'table_method' => 'getMyPassengers')));
        // The validators must be changed too
        $this->setValidator('carpool_id',new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'required' => false)));
        $this->setValidator('passenger_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'required' => false)));

        $this->widgetSchema->setLabel('price', 'Price <span class="negotiate-dollar-sign">$</span>');
        // Seat status will be created by the action, not the user
        unset($this['seat_status_id']);
        
        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        $this->useFields(array(
            'seat_id',
            'route',
            'carpool_id',
            'passenger_id',
            'pickup_date',
            'pickup_time',
            'price',
            'seat_count',
            'description'));
    }

    /**
     * Saves the seat in the form
     * @param Doctrine_Connection $con The connection to the database
     */
    public function doSave($con = null)
    {
        // Get the person id of the authenticated user
        $person = sfContext::getInstance()->getUser()->getGuardUser()->getPeople();
        
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
            
            // Update the route in this seat's object
            $this->getObject()->setRoutes($updatedRoute);
            $routeId = $updatedRoute->getRouteId();
            
            $routeChanged = true;
        }
        
        // Handle the link to the carpool. If it is
        // empty, then create a new entry.
        if($this->values['carpool_id'] == '')
        {
            // Create a new carpool based on the seat information
            $newCarpool = new Carpools();
            $newCarpool->asking_price = $this->values['price'];
            // Do not set description because it may not be the same
            $newCarpool->description = "";
            $newCarpool->driver_id = $person->getPersonId();
            // For now, all posts are public
            $newCarpool->isPublic = true;
            $newCarpool->route_id = $routeId;
            $newCarpool->seats_available = $this->values['seat_count'];
            $newCarpool->solo_route_id = $routeId;
            $newCarpool->start_date = $this->values['pickup_date'];
            $newCarpool->start_time = $this->values['pickup_time'];
            // Set the default vehicle. For now just set this to be the user's
            // first vehicle if they have one.
            if ($person->getVehicles()->count() > 0)
            {
                $newCarpool->setVehicles($person->getVehicles()->getFirst());
            }
            
            // Save the Carpool
            $newCarpool->save();
            
            // Set the seat carpool_id to be the new carpool
            $this->values['carpool_id'] = $newCarpool->getCarpoolId();
        }
        
        // Handle the link to the passenger. If it is
        // empty, then create a new entry.
        if($this->values['passenger_id'] == '')
        {
            // Create a new passenger based on the seat information
            $newPassenger = new Passengers();
            $newPassenger->asking_price = $this->values['price'];
            // Do not set description because it may not be the same
            $newPassenger->description = "";
            $newPassenger->person_id = $person->getPersonId();
            // For now, all posts are public
            $newPassenger->isPublic = true;
            $newPassenger->passenger_count = $this->values['seat_count'];
            $newPassenger->solo_route_id = $routeId;
            $newPassenger->start_date = $this->values['pickup_date'];
            $newPassenger->start_time = $this->values['pickup_time'];

            // Save the Passenger
            $newPassenger->save();

            // Set the seat passenger_id to be the new passenger
            $this->values['passenger_id'] = $newPassenger->getPassengerId();
        }
        
        // Change the behavior of the parent doSave. The difference is the 
        // embedded route should be saved first
        if (null === $con)
        {
            $con = $this->getConnection();
        }
        
        // Update the route id of the seat if the route has changed to make 
        // sure it does not get overwritten
        if ($routeChanged)
        {
            $this->values['solo_route_id'] = $routeId;
            $this->values['route']['route_id'] = $routeId;
        }

        $this->updateObject();
        $this->getObject()->save($con);
    }

}
