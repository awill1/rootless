<?php

/**
 * Creates passenger rides
 *
 * @author awilliams
 */
class PassengerFactory extends RideFactory {
    
    /**
     * Creates a ride
     */
    public static function createRide($date, $time, $person, $seatCount, $price, $routeData, $originData, $destinationData)
    {
        // Create the passenger post
        $passenger = new Passengers();

        // Set the minumum amount of data known
        $passenger->setStartDate($date);
        $passenger->setStartTime($time);
        $passenger->setStatusId(RideStatuses::$statuses[RideStatuses::RIDE_OPEN]);
        $passenger->setPeople($person);
        $passenger->setPassengerCount($seatCount);
        $passenger->setAskingPrice($price);


        // Create the route from passed in data. The save happens inside
        // of the createFromGoogleDirections function.
        $route = new Routes();
        $route->createFromGoogleDirections($routeData, $originData, $destinationData);

        $passenger->setRoutes($route);

        $passenger->save();
        
        return $passenger;
    }
}

?>
