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
        // Bind the route object to the seat's route
        $seat->Routes = $route;
        // Create the embedded seat form
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
        $this->setWidget('carpool_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 
                                                                           'add_empty' => true,
                                                                           'table_method' => 'getMyCarpools')));
        $this->setWidget('passenger_id',new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'),
                                                                             'add_empty' => true,
                                                                             'table_method' => 'getMyPassengers')));
        // The validators must be changed too
        $this->setValidator('carpool_id',new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carpools'), 'required' => false)));
        $this->setValidator('passenger_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Passengers'), 'required' => false)));

        // Seat status will be created by the action, not the user
        //$this->setWidget('seat_status_id',new sfWidgetFormInputText());
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
     * @return Seats The saved seat
     */
    public function doSave($con = null) {
        // Get the person id of the authenticated user
        $person = sfContext::getInstance()->getUser()->getGuardUser()->getPeople();
        
        // Get the original route id
        $routeId = $this->values['route']['route_id'];
        
        // Only create a route if there is route data, because
        // this means the route is new or has been changed
        if ($this->values['route']['route_data'] != '')
        {
            // Get the route data from the embedded form
            $route_data = $this->values['route']['route_data'];
            $origin_data = $this->values['route']['origin_data'];
            $destination_data = $this->values['route']['destination_data'];

            // Create a new route
            $route = new Routes();
            $route->createFromGoogleDirections($route_data, $origin_data, $destination_data);
            
            // Update the route id
            $routeId = $route->getRouteId();
        }

        // Handle the link to the carpool and passengers. If either one is
        // empty, then create a new entry
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

            // Set the seat carpool_id to be the new carpool
            $this->values['passenger_id'] = $newPassenger->getPassengerId();
        }
        
        
        // Call the parent function to save the seat
        parent::doSave($con);
        $updatedSeat = $this->getObject();
        
        // Update the route id in the seat if necessary
        if ($routeId != $updatedSeat->getSoloRouteId())
        {            
            // Update the seat with the new route id
            $updatedSeat->setSoloRouteId($routeId);
            $updatedSeat = $updatedSeat->save();
        }
        
        // Return the updated seat
        return $updatedSeat;
    }
}
