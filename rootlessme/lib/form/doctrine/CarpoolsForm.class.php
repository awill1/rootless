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
        // date and time picker.
        // The default date validator will still work
        $this->setWidget('start_date',new sfWidgetFormInputText());
        $this->setWidget('start_time',new sfWidgetFormInputText());

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
    
    public function doSave($con = null) {
//        sfContext::getInstance()->getLogger()->info('Save values:');
//        sfContext::getInstance()->getLogger()->info(var_dump($this->getValues()));

        
        $route_data = $this->values['route']['route_data'];

        // Update the route
        $route = $this->getObject()->Routes;
        $route->createFromGoogleDirections($route_data);

        // Update the route_id value so it does not get overwritten by the
        // internal updateObject() call
        $this->values['route']['route_id'] = $route->getRouteId();

        // Update the origin and destination to use the geocoded information
        $origin_data = $this->values['route']['origin_data'];
        $origin = $route->getOriginLocation();
        $origin->createFromGoogleGeocode($origin_data);
        $destination_data = $this->values['route']['destination_data'];
        $destination = $route->getDestinationLocation();
        $destination->createFromGoogleGeocode($destination_data);

        // The driver should be the user who is logged in
        $this->values['driver_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();

        return parent::doSave($con);
    }

}
