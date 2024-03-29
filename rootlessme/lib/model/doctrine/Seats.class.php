<?php

/**
 * Seats
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Seats extends BaseSeats
{
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
     * Gets the origin location for a route
     * @return String The origin
     */
    public function getOriginString()
    {
        $first_location = $this->getRoutes()->getOriginString();

        return $first_location;
    }

    /**
     * Gets the destination location for a route
     * @return String The destination
     */
    public function getDestinationString()
    {
        $last_location = $this->getRoutes()->getDestinationString();

        return $last_location;
    }
    
    /**
     * Saves the seat and saves the schange into the history log
     * @param int $personId
     * @param Doctrine_Connection $conn THe doctrine connection
     * @return Seats The saved seat
     */
    public function saveWithHistory($personId, Doctrine_Connection $conn = null)
    {
        // Get the connection information
        $conn = $conn ? $conn : $this->getTable()->getConnection();
        // Begin a transaction so it can be rolled back if something goes
        // wrong
        $conn->beginTransaction();
        try
        {
            // Get the is new value since it will change after saving
            $isNew = $this->isNew();

            // If the seat is new, set the status to be pending
            $action = 'update';
            if ($isNew)
            {
                $pendingStatusId = SeatStatusesTable::getInstance()->findOneBy('slug', 'pending')->getSeatStatusId();
                $this->setSeatStatusId($pendingStatusId);
                // The seat is new so the action is create
                $action = 'create';
            }
            
            // Save the seat
            parent::save($conn);
            
            // Create the seat history record
            $seatHistoryEntry = SeatsHistory::createHistoryFromSeat($this, $personId, $action);

            // Save the history record
            $seatHistoryEntry = $seatHistoryEntry->save();

            // Commit the transaction
            $conn->commit();

            return $this;
        }
        catch (Exception $e)
        {
            $conn->rollBack();
            throw $e;
        }
    }
    
    /**
     * Checks to see if a person is the driver or passenger for a seat
     * @param type $personId The user's person id
     * @return boolean True if the user is the driver or passenger. False
     * otherwise
     */
    public function isMySeat($personId)
    {
        $isMySeat = false;
        
        // Check to see if the user is the driver
        if ($this->isDriver($personId))
        {
            $isMySeat = true;
        }
        else if ($this->isPassenger($personId)) 
        {
            $isMySeat = true;
        }
        return $isMySeat;
    }
    
    /**
     * Checks to see if a person is the driver for a seat.
     * @param Integer $personId The person id
     * @return boolean True, if the person is the driver. False, otherwise.
     */
    public function isDriver($personId)
    {
        $isDriver = false;
        
        // Check to see if the user is the driver
        if ($this->getCarpools()->getDriverId() == $personId)
        {
            $isDriver = true;
        }
        return $isDriver;
    }
    
    /**
     * Checks to see if a person is the passenger for a seat.
     * @param type $personId The person id
     * @return boolean True, if the person is the passenger. False, otherwise.
     */
    public function isPassenger($personId)
    {
        $isPassenger = false;
        
        // Check to see if the user is the passenger
        if ($this->getPassengers()->getPersonId() == $personId) 
        {
            $isPassenger = true;
        }
        return $isPassenger;
    }
    
    /**
     * Gets the ride for the person
     * @param Integer $personId The person id
     * @return mixed A carpool if the person is the driver. A passenger if the 
     * person is a passenger. Null, otherwise. 
     */
    public function getMyRide($personId)
    {
        $myRide = NULL;

        // Check to see if the user is the driver
        if ($this->isDriver($personId))
        {
            $myRide = $this->getCarpools();
        }
        else if ($this->isPassenger($personId))
        {
            $myRide = $this->getPassengers();
        }
        
        return $myRide;
    }
    
    /**
     * Checks to see whether the user can put the seat into the accepted state.
     * @param int $personId The user's person id
     * @return boolean True if the user is able to accept the seat. False
     * otherwise.
     */
    public function canAccept($personId)
    {
        $canAccept = false;
        // Check to make sure the person is involved in the seat
        if ($this->isMySeat($personId))
        {
            // This logic need to be expanded more
            
            // Two inputs determine if the user can decline the seat
            // 1. The state of the seat
            // 2. Whether the user made the last change to the seat
            $seatStatusId = $this->getSeatStatusId();
            $lastHistory = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryForSeat($this->getSeatId());
            
            // Whether the user can decline depends on the state of the seat
            switch ($seatStatusId) {
                case SeatStatusesTable::$rideTypes['accepted']:
                    // The seat is already accepted so it cannot be accepted again
                    $canAccept = false;
                    break;
                case SeatStatusesTable::$rideTypes['declined']:
                    // If the user declined the ride last, they can accept
                    $didUserChangeLast = $lastHistory->getChangerId() == $personId;
                    if ($didUserChangeLast)
                    {
                        $canAccept = true;
                    }
                    else
                    {
                        $canAccept = false;
                    }
                    break;
                case SeatStatusesTable::$rideTypes['pending']:
                    // If the user made the last change to the seat they can not
                    // be the one to accept it
                    $didUserChangeLast = $lastHistory->getChangerId() == $personId;
                    if ($didUserChangeLast)
                    {
                        $canAccept = false;
                    }
                    else
                    {
                        $canAccept = true;
                    }
                    break;
                case SeatStatusesTable::$rideTypes['recommended']:
                    // Negotiation have not started yet.
                    $canAccept = false;
                    break;
                default:
                    // Unknown seat status id
                    $canAccept = false;
                    break;
            }
        }

        return $canAccept;
    }
    
    /**
     * Checks to see whether the user can put the seat into the edit state.
     * @param int $personId The user's person id
     * @return boolean True if the user is able to accept the seat. False
     * otherwise.
     */
    public function canEdit($personId)
    {
        $canEdit = false;
        // Check to make sure the person is involved in the seat
        if ($this->isMySeat($personId))
        {
            
            $seatStatusId = $this->getSeatStatusId();
            $lastHistory = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryForSeat($this->getSeatId());
            
            // Whether the user can edit depends on the state of the seat
            switch ($seatStatusId) {
                case SeatStatusesTable::$rideTypes['accepted']:
                    // The seat is already accepted so it can be edited if plans change.
                    $canEdit = true;
                    break;
                case SeatStatusesTable::$rideTypes['declined']:
                    // If the user declined the ride last, they can edit
                    $didUserChangeLast = $lastHistory->getChangerId() == $personId;
                    if ($didUserChangeLast)
                    {
                        $canEdit = true;
                    }
                    else
                    {
                        $canEdit = false;
                    }
                    break;
                case SeatStatusesTable::$rideTypes['pending']:
                    // any user can edit a pending seat
                    $canEdit = true;
                    break;
                case SeatStatusesTable::$rideTypes['recommended']:
                    // Negotiation have not started yet.
                    $canEdit = true;
                    break;
                default:
                    // Unknown seat status id
                    $canEdit = false;
                    break;
            }
        }

        return $canEdit;
    }
    
    /**
     * Checks to see whether the user can put the seat into the declined state.
     * @param int $personId The user's person id
     * @return boolean True if the user is able to decline the seat. False
     * otherwise.
     */
    public function canDecline($personId)
    {
        $canDecline = false;
        
        // Check to make sure the person is involved in the seat
        if ($this->isMySeat($personId))
        {
            // This logic need to be expanded 
            
            // Two inputs determine if the user can decline the seat
            // 1. The state of the seat
            // 2. Whether the user made the last change to the seat
            $seatStatusId = $this->getSeatStatusId();
            $lastHistory = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryForSeat($this->getSeatId());
            
            // Whether the user can decline depends on the state of the seat
            switch ($seatStatusId) {
                case SeatStatusesTable::$rideTypes['accepted']:
                    // An user involved in the seat can decline at any time
                    $canDecline = true;
                    break;
                case SeatStatusesTable::$rideTypes['declined']:
                    // The seat is already declined so it cannot be declined again
                    $canDecline = false;
                    break;
                case SeatStatusesTable::$rideTypes['pending']:
                    // An user involved in the seat can decline at any time
                    $canDecline = true;
                    break;
                case SeatStatusesTable::$rideTypes['recommended']:
                    // Negotiations have not started yet.
                    $canDecline = false;
                    break;
                default:
                    // Unknown seat status id
                    $canDecline = false;
                    break;
            }
        }

        return $canDecline;
    }
}
