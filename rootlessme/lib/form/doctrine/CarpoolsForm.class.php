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

        // Embedded route subform
        $solo_route = new Routes();
        $this->getObject()->Routes_3 = $solo_route;
        $this->getObject()->Routes = $solo_route;
        $solo_route_form = new RoutesForm($solo_route);
        $this->embedForm('route', $solo_route_form);


        // Change the vehicle list to only include the user's vehicles
        $personId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
        $this->setWidget('vehicle_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Vehicles'),
            'add_empty' => false,
            'query' => Doctrine::getTable('Vehicles')->getQueryForPerson($personId)
                )));
        // Change the start date and time widgets to be  textboxs for the
        // date and time picker. The default date validator will still work
        $this->setWidget('start_date',new sfWidgetFormInputText());
        $this->setWidget('start_time',new sfWidgetFormInputText());
        
        $this->widgetSchema->setLabel('asking_price', 'Asking Price (per person)');

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
    public function doSave($con = null) {
        // Get the route data from the embedded form
        $route_data = $this->values['route']['route_data'];
        $origin_data = $this->values['route']['origin_data'];
        $destination_data = $this->values['route']['destination_data'];

        // Update the route
        $route = $this->getObject()->Routes;
        $route->createFromGoogleDirections($route_data, $origin_data, $destination_data);

        // Update the route_id value so it does not get overwritten by the
        // internal updateObject() call
        $this->values['route']['route_id'] = $route->getRouteId();

        // The driver should be the user who is logged in
        $this->values['driver_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();

        parent::doSave($con);
    }

}
