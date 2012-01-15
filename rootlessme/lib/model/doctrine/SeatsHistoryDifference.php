<?php

/**
 * SeatsHistoryDifference
 * 
 * Shows what has changed between seat history items
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class SeatsHistoryDifference
{
    /**
     * Private member variable for the older seat history item
     * @var SeatsHistory The older seat history
     */
    private $mOldSeatHistory = null;
    
    /**
     * Private member variable for the newer seat history item
     * @var SeatsHistory The newer seat history
     */
    private $mNewSeatHistory = null;
    
    private $isSeatStatusIdDifferent = false;
    private $isSoloRouteIdDifferent = false;
    private $isPriceDifferent = false;
    private $isSeatCountDifferent = false;
    private $isPickupDateDifferent = false;
    private $isPickupTimeDifferent = false;
    private $isDescriptionDifferent = false;

    /**
     * Creates a new SeatsHistoryDifference between two seat history objects
     * @param SeatsHistory $oldSeatHistory The older seat history to compare
     * @param SeatsHistory $newSeatHistory The newer seat history to compare
     */
    public function __construct($oldSeatHistory, $newSeatHistory)
    {
        $this->mOldSeatHistory = $oldSeatHistory;
        $this->mNewSeatHistory = $newSeatHistory;
        $this->detectDifferences();
    }
    
    /**
     * Gets the old seat history item
     * @return SeatsHistory The old seat history item 
     */
    public function getOldSeatHistory()
    {
        return $this->mOldSeatHistory;
    }
    
    /**
     * Gets the new seat history item
     * @return SeatsHistory The new seat history item
     */
    public function getNewSeatHistory()
    {
        return $this->mNewSeatHistory;
    }
    
    /**
     * Detects the differences between the old and new seat history items
     */
    private function detectDifferences()
    {
        // If the old value is null but the new item is not null, then the
        // item is new and everything has changed
        if ($this->mOldSeatHistory == null && $this->mNewSeatHistory != null)
        {
            $this->isSeatStatusIdDifferent = true;
            $this->isSoloRouteIdDifferent = true;
            $this->isPriceDifferent = true;
            $this->isSeatCountDifferent = true;
            $this->isPickupDateDifferent = true;
            $this->isPickupTimeDifferent = true;
            $this->isDescriptionDifferent = true;
        }
        elseif ($this->mOldSeatHistory != null && $this->mNewSeatHistory != null)
        {
            // Check the properties to see if they are different
            if ($this->mOldSeatHistory->getSeatStatusId() != $this->mNewSeatHistory->getSeatStatusId())
            {
                $this->isSeatStatusIdDifferent = true;
            }
            $this->isSoloRouteIdDifferent = $this->mOldSeatHistory->getSoloRouteId() != $this->mNewSeatHistory->getSoloRouteId();
            $this->isPriceDifferent = $this->mOldSeatHistory->getPrice() != $this->mNewSeatHistory->getPrice();
            $this->isSeatCountDifferent = $this->mOldSeatHistory->getSeatCount() != $this->mNewSeatHistory->getSeatCount();
            $this->isPickupDateDifferent = $this->mOldSeatHistory->getPickupDate() != $this->mNewSeatHistory->getPickupDate();
            $this->isPickupTimeDifferent = $this->mOldSeatHistory->getPickupTime() != $this->mNewSeatHistory->getPickupTime();
            $this->isDescriptionDifferent = $this->mOldSeatHistory->getDescription() != $this->mNewSeatHistory->getDescription();
        }
    }
    
    /**
     * Gets whether the seat status id is different between the old and new
     * seat history items.
     * @return boolean True, if the seat status id is different. False,
     * otherwise. 
     */
    public function getIsSeatStatusIdDifferent()
    {
        return $this->isSeatStatusIdDifferent;
    }
    
    /**
     * Gets whether the solo route id is different between the old and new
     * seat history items.
     * @return boolean True, if the solo route id is different. False,
     * otherwise. 
     */
    public function getIsSoloRouteIdDifferent()
    {
        return $this->isSoloRouteIdDifferent;
    }
    
    /**
     * Gets whether the price is different between the old and new
     * seat history items.
     * @return boolean True, if the price is different. False,
     * otherwise. 
     */
    public function getIsPriceDifferent()
    {
        return $this->isPriceDifferent;
    }
    
    /**
     * Gets whether the seat count is different between the old and new
     * seat history items.
     * @return boolean True, if the seat count is different. False,
     * otherwise. 
     */
    public function getIsSeatCountDifferent()
    {
        return $this->isSeatCountDifferent;
    }
    
    /**
     * Gets whether the pickup date is different between the old and new
     * seat history items.
     * @return boolean True, if the pickup date is different. False,
     * otherwise. 
     */
    public function getIsPickupDateDifferent()
    {
        return $this->isPickupDateDifferent;
    }
    
    /**
     * Gets whether the pickup time is different between the old and new
     * seat history items.
     * @return boolean True, if the pickup time is different. False,
     * otherwise. 
     */
    public function getIsPickupTimeDifferent()
    {
        return $this->isPickupTimeDifferent;
    }
    
    /**
     * Gets whether the description is different between the old and new
     * seat history items.
     * @return boolean True, if the description is different. False,
     * otherwise. 
     */
    public function getIsDescriptionDifferent()
    {
        return $this->isDescriptionDifferent;
    }
}
