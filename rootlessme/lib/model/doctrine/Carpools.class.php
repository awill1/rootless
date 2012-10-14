<?php

/**
 * Carpools
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Carpools extends BaseCarpools
{
    /**
     * Gets the ride id. Common function for ride types. This should be an interface.
     * @return Integer The ride id
     */
    public function getRideId()
    {
        return $this->getCarpoolId();
    }
    
    /**
     * Gets the ride type. Common function for ride types. This should be an interface.
     * @return String The ride type
     */
    public function getRideType()
    {
        return 'offer';
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
     * Returns a string that represents the carpool. Overrides the default
     * __toString method.
     * @return string The carpool represented as a string
     */
    public function __toString()
    {
        $carpoolName = "";
        $route = $this->getRoutes();
        $carpoolName = date("m/d/Y",strtotime($this->getStartDate()))." - ".$route->getOriginString()." to ".$route->getDestinationString();

        return $carpoolName;

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
        
        // Check to see if the user is the driver
        if ($this->getDriverId() == $personId)
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
     * Finds potential passengers for the driver
     * @param float $distance The distance to search for in miles
     * @return Doctrine_Collection The matched passengers
     */
    public function findPassengers($distance)
    {
        $results = Doctrine_Core::getTable('Passengers')
             ->getAlongRoute($distance, $this->getRoutes()->getEncodedPolyline(), $this->getStartDate());

        return $results;
    }
}