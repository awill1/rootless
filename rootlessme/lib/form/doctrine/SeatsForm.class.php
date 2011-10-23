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
    public function configure()
    {
        $seat = $this->getObject();

        // Get the seat's route or create a new one
        if ($seat != null)
        {
            $route = $this->getObject()->getRoutes();
        }
        else
        {
            $route = new Routes();
        }
        $route_form = new RoutesForm($route);
        // Override the label for a few select fields
        $route_form->widgetSchema->setLabel('origin', 'Pickup Location');
        $route_form->widgetSchema->setLabel('destination', 'Dropoff Location');
        $this->embedForm('route', $route_form);

        // Change the pickup date and time widgets to be textboxs for the
        // date and time picker. The default date and time validators will
        // still work
        $this->setWidget('pickup_date',new sfWidgetFormInputText());
        $this->setWidget('pickup_time',new sfWidgetFormInputText());

        // Create the carpool and passenger choices, allowing the empty option
        $this->setWidget('carpool_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'add_empty' => true)));
        $this->setWidget('passenger_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'add_empty' => true)));

        // Choose the fields that will be displayed
        unset($this['created_at']);
        unset($this['updated_at']);
        // Seat status will be created by the action, not the user
        unset($this['seat_status_id']);
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

    public function doSave($con = null) {
        // Get the route data from the embedded form
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

        // Since this is a new seat, set the status to be pending
        //$this->values['seat_status_id'] = Doctrine_Core::getTable('SeatStatusesTable')->findOneBy('slug', 'pending')->getSeatStatusId();

        // 
        //$userId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();

        // Handle the link to the carpool and passengers

        // Call the parent function to save the seat
        return parent::doSave($con);
    }
}
