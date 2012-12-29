<?php

/**
 * Creates driver rides
 *
 * @author awilliams
 */
class CarpoolFactory extends RideFactory {
    
    /**
     * Creates a ride
     */
    public static function createRide($date, $time, $person, $seatCount, $price, $routeData, $originData, $destinationData)
    {
        // Create the carpool
        $carpool = new Carpools();

        // Set the minumum amount of data known
        $carpool->setStartDate($date);
        $carpool->setStartTime($time);
        $carpool->setStatusId(RideStatuses::$statuses[RideStatuses::RIDE_OPEN]);
        $carpool->setPeople($person);
        $carpool->setSeatsAvailable($seatCount);
        $carpool->setAskingPrice($price);


        // Create the route from passed in data. The save happens inside
        // of the createFromGoogleDirections function.
        $route = new Routes();
        $route->createFromGoogleDirections($routeData, $originData, $destinationData);

        $carpool->setRoutes($route);
        $carpool->setSoloRouteId($route->getRouteId());

        // Save the carpool
        $carpool->save();
        
        return $passenger;
    }
}

?>
