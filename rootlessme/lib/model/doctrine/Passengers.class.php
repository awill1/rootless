<?php

/**
 * Passengers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Passengers extends BasePassengers
{
    /**
     * Gets the ride id. Common function for ride types. This should be an interface.
     * @return Integer The ride id
     */
    public function getRideId()
    {
        return $this->getPassengerId();
    }
    
    /**
     * Gets the ride type. Common function for ride types. This should be an interface.
     * @return String The ride type
     */
    public function getRideType()
    {
        return 'request';
    }
    
    /**
     * Gets the number of seats needed. Common function for ride types. This
     * should be an interface.
     * @return Integer The seat count
     */
    public function getSeatCount()
    {
        return $this->getPassengerCount();
    }
    
    /**
     * Gets the origin location for a route
     * @return Locations The origin
     */
    public function getOriginLocation()
    {
        $first_location = $this->getRoutes()->getOriginLocation();

        return $first_location;
    }

    /**
     * Gets the destination location for a route
     * @return Locations The destination
     */
    public function getDestinationLocation()
    {
        $last_location = $this->getRoutes()->getDestinationLocation();

        return $last_location;
    }
    
    /**
     * Returns a string that represents the passenger. Overrides the default
     * __toString method.
     * @return string The passenger represented as a string
     */
    public function __toString()
    {
        $passengerName = "";
        $route = $this->getRoutes();
        $passengerName = date("m/d/Y",strtotime($this->getStartDate()))." - ".$route->getOriginString()." to ".$route->getDestinationString();

        return $passengerName;

    }
    
    /**
     * Checks to see if a person is the owner of the ride post
     * @param type $personId The user's person id
     * @return boolean True if the user is the poster. False
     * otherwise
     */
    public function isMyRide($personId)
    {
        $isMyRide = false;
        
        // Check to see if the user is the passenger
        if ($this->getPersonId() == $personId) 
        {
            $isMyRide = true;
        }
        
        return $isMyRide;
    }
    
    /**
     * Checks to see if the ride is deleted
     * @return boolean True if the ride is deleted. False, otherwise.
     */
    public function isDeleted()
    {
        $isDeleted = false;
        
        // Check to see if the ride status is deleted
        if ($this->getStatusId() == RideStatuses::$statuses[RideStatuses::RIDE_DELETED])
        {
            $isDeleted = true;
        }
        
        return $isDeleted;
    }
    
    /**
     * Finds potential drivers for the passenger
     * @param float $distance The distance to search for in miles
     * @return Doctrine_Collection The matched drivers
     */
    public function findDrivers($distance)
    {
        $origin = $this->getOriginLocation();
        $destination = $this->getDestinationLocation();
        
        $results = Doctrine_Core::getTable('Carpools')->getNearPoints (
                                   $distance,
                                   $origin->getLatitude(),
                                   $origin->getLongitude(),
                                   $destination->getLatitude(),
                                   $destination->getLongitude(),
                                   $this->getStartDate());
        
        return $results;
    }
      
    /**
     * Creates recommendations for potential drivers for the passenger
     * @param float $distance The distance to search for in miles
     * @return Doctrine_Collection The new recommendations
     */
    public function recommendDrivers($distance)
    {
        $recommendations = new Doctrine_Collection('Seats');
        
        // Get the passenger id
        $passengerId = $this->getPersonId();
        
        // Get all driver matches
        $matches = $this->findDrivers($distance);
        
        // Get all existing seats for this ride
        $existingSeats = $this->getSeats();
        
        // Go through all of the matches
        foreach ($matches as $match)
        {
            $matchCarpoolId = $match->getCarpoolId();
            
            // Only create a seat recommendation if there is not already a seat
            // between this driver and passenger
            $seatAlreadyExists = false;
            for($i = 0 ; $i < $existingSeats->count() && !$seatAlreadyExists ; $i++)
            {
                // Is the driver in this existing seat?
                $seatAlreadyExists = $existingSeats[$i]->getCarpoolId() == $matchCarpoolId;
            }
            
            // If there was no existing seat, create the recommendation
            if (!$seatAlreadyExists)
            {
                // Make sure the driver is not also the passenger
                if ($match->getDriverId() != $passengerId)
                {
                    // Create the recommendation
                    $recommendation = Doctrine_Core::getTable('Seats')->createSeatRecommendation($match, $this);

                    if ($recommendation)
                    {
                        // Add the recommendation to the recommendation list
                        $recommendations->add($recommendation);

                        // Send a notification to the other user
                        $notification = new seatRecommendedNotification($recommendation, $match->getPeople(), $this->getPeople());
                        $notification->sendNotifications();
                    }
                }
            }
        }

        return $recommendations;
    }
}
