<?php

/**
 * The actions for the seat components.
 */
class seatComponents extends sfComponents
{
    /**
     * Executes the action for the _negotiation component.
     * @param sfWebRequest $request The web request
     */
    public function executeNegotiation(sfWebRequest $request)
    {
        // Get the user id. The user must be authenticated
        $userId = $this->getUser()->getGuardUser()->getPersonId();
        
        // Get the seat type and number from the request parameters
        $this->seat = $this->getVar('seat');
        
        // Form and seat needed for seat negotiation
        $this->form = new SeatsNegotiationForm($this->seat);
        
        // Get the seat negotiation changes history
        $this->negotiationChangesHistory = Doctrine_Core::getTable('SeatsHistory')
                              ->getHistoryDifferencesForSeat($this->seat->getSeatId());
        
        // Get the actions available to the user
        $this->canAccept = $this->seat->canAccept($userId);
        $this->canDecline = $this->seat->canDecline($userId);
        $this->canEdit = $this->seat->canEdit($userId);
    }
    
    /**
     * Executes the action for the _editSeat component.
     * @param sfWebRequest $request The web request
     */
    public function executeEditSeat(sfWebRequest $request)
    {
        // Get the user id. The user must be authenticated
        $userId = $this->getUser()->getGuardUser()->getPersonId();
        
        // Get the seat type and number from the request parameters
        $this->seat = $this->getVar('seat');
        
        $this->otherPersonProfile = null;
        
        if ($this->seat->getCarpools()->getDriverId() == $userId){
            $this->otherPersonProfile = $this->seat->getPassengers()->getPeople()->getProfiles();
        }else{
            $this->otherPersonProfile = $this->seat->getCarpools()->getPeople()->getProfiles();
        }
        
        // Form and seat needed for seat negotiation
        $this->form = new SeatsNegotiationForm($this->seat);
        
        // Get the seat negotiation changes history
        $this->negotiationChangesHistory = Doctrine_Core::getTable('SeatsHistory')
                              ->getHistoryDifferencesForSeat($this->seat->getSeatId());
        
        // Get the actions available to the user
        $this->canAccept = $this->seat->canAccept($userId);
        $this->canDecline = $this->seat->canDecline($userId);
        $this->canEdit = $this->seat->canEdit($userId);
    }
    
    /**
     * Executes the action for the _showSeat component.
     * @param sfWebRequest $request The web request
     */
    public function executeShowSeat(sfWebRequest $request)
    {
        // Get the user id. The user must be authenticated
        $userId = $this->getUser()->getGuardUser()->getPersonId();
        
        // Get the seat type and number from the request parameters
        $this->seat = $this->getVar('seat');
        
        $this->otherPersonProfile = null;
        
        if ($this->seat->getCarpools()->getDriverId() == $userId){
            $this->otherPersonProfile = $this->seat->getPassengers()->getPeople()->getProfiles();
        }else{
            $this->otherPersonProfile = $this->seat->getCarpools()->getPeople()->getProfiles();
        }
        
        // Form and seat needed for seat negotiation
        $this->form = new SeatsNegotiationForm($this->seat);
        
        // Get the seat negotiation changes history
        $this->negotiationChangesHistory = Doctrine_Core::getTable('SeatsHistory')
                              ->getHistoryDifferencesForSeat($this->seat->getSeatId());
        
        // Get the actions available to the user
        $this->canAccept = $this->seat->canAccept($userId);
        $this->canDecline = $this->seat->canDecline($userId);
        $this->canEdit = $this->seat->canEdit($userId);
        
   
        //look in base history to find how to get name from History object
        $this->lastHistory = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryForSeat($this->seat->getSeatId());
        //did the viewer change something last
        $this->didUserChangeLast = false;
        if ($this->lastHistory)
        {
            $this->didUserChangeLast = $this->lastHistory->getChangerId() == $userId;
        }
    }
    

    /**
     * Executes the action for the _negotiationItem component.
     * @param sfWebRequest $request The web request
     */
    public function executeNegotiationItem(sfWebRequest $request)
    {
        // Get the seat negotiation change item from the request parameters
        $this->negotiationChange = $this->getVar('negotiationChange');

        // Get the new history item from the difference
        $this->newHistoryItem = $this->negotiationChange->getNewSeatHistory();
        // Get the changer
        $this->changer = $this->newHistoryItem->getPeople()->getProfiles();
        // Get the route
        $this->route = $this->newHistoryItem->getRoutes();
    }
    
    /**
     * Executets the action for the _offerForm
     * @param sfWebRequest $request The web request
     */
    public function executeOfferForm(sfWebRequest $request)
    {
        // Get ride from the request
        $this->ride = $this->getVar('ride');

        // Create the seat
        $this->seat = new Seats();

        // The ride was an request so set the passenger field
        $this->seat->setPassengers($this->ride);
        // Set the default seat count
        // The ride type was a request, so the default is as many seats
        // as there were in the request
        $this->seat->setSeatCount($this->ride->getPassengerCount());

        // Set the default price to be the same as the ride price
        $this->seat->setPrice($this->ride->getAskingPrice());
        
        
        // Set the default pickup date and time. accont for anyday/anytime nulls
        if (is_null($this->ride->getStartDate())){
            //use present date
            $this->seat->setPickupDate(date("m/d/Y",strtotime(date('Y-m-d H:i:s')))); 
        }else{
            $this->seat->setPickupDate(date("m/d/Y",strtotime($this->ride->getStartDate())));
        }
        if (is_null($this->ride->getStartTime())){
            //use present time
            $this->seat->setPickupTime(date("g:i a",strtotime(date('Y-m-d H:i:s'))));
        }else{
            $this->seat->setPickupTime(date("g:i a",strtotime($this->ride->getStartTime())));
        }
        

        // Create the seat form
        $this->seatForm = new SeatsOfferForm($this->seat);

        if ($this->getUser()->isAuthenticated())
        {
            $myId = $this->getUser()->getGuardUser()->getPersonId();
            //$myId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
            $this->carpools = Doctrine_Core::getTable('Carpools')->getCarpoolsForPerson($myId);
        }
    }

    /**
     * Executets the action for the _requestForm
     * @param sfWebRequest $request The web request
     */
    public function executeRequestForm(sfWebRequest $request)
    {
        // Get ride from the request
        $this->ride = $this->getVar('ride');

        // Create the seat
        $this->seat = new Seats();
        
        // Get the authenticated user's personId
        if ($this->getUser()->isAuthenticated())
        {
            $myId = $this->getUser()->getGuardUser()->getPersonId();
            //$myId = sfContext::getInstance()->getUser()->getGuardUser()->getPersonId();
            $this->passengers = Doctrine_Core::getTable('Passengers')->getPassengersForPerson($myId);
        }
        // The ride was an offer so set the carpool field
        $this->seat->setCarpools($this->ride);
        // Set the default seat count
        // The ride type was an offer, so the default is taking up just
        // 1 passenger seat
        $this->seat->setSeatCount(1);

        // Set the default price to be the same as the ride price
        $this->seat->setPrice($this->ride->getAskingPrice());
        
        // Set the default pickup date. Maybe set default time. Account for null anyday or anytime values
        if (is_null($this->ride->getStartDate()))
        {
             //use present date
             $this->seat->setPickupDate(date("m/d/Y",strtotime(date('Y-m-d H:i:s')))); 
        }else{
             //use ride date  
             $this->seat->setPickupDate(date("m/d/Y",strtotime($this->ride->getStartDate())));
        }
        if (is_null($this->ride->getStartTime())){
            //use present time
            $this->seat->setPickupTime(date("g:i a",strtotime(date('Y-m-d H:i:s'))));
        }else{
            //use ride time
            $this->seat->setPickupTime(date("g:i a",strtotime($this->ride->getStartTime())));
        }
        

        // Create the seat form
        $this->seatForm = new SeatsRequestForm($this->seat);
    }
}
