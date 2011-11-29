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

        // Get the seat negotiations
        $this->negotiations = Doctrine_Core::getTable('SeatsHistory')
                              ->getHistoryForSeat($this->seat->getSeatId());
        
        // Get the actions available to the user
        $this->canAccept = $this->seat->canAccept($userId);
        $this->canDecline = $this->seat->canDecline($userId);
    }

    /**
     * Executes the action for the _negotiationItem component.
     * @param sfWebRequest $request The web request
     */
    public function executeNegotiationItem(sfWebRequest $request)
    {
        // Get the seat negotiation item from the request parameters
        $this->negotiation = $this->getVar('negotiationItem');

        // Get the changer
        $this->changer = $this->negotiation->getPeople()->getProfiles()->getFirst();
        // Get the route
        $this->route = $this->negotiation->getRoutes();
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

        // Create the seat form
        $this->seatForm = new SeatsOfferForm($this->seat);
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

        // The ride was an offer so set the carpool field
        $this->seat->setCarpools($this->ride);
        // Set the default seat count
        // The ride type was an offer, so the default is taking up just
        // 1 passenger seat
        $this->seat->setSeatCount(1);

        // Set the default price to be the same as the ride price
        $this->seat->setPrice($this->ride->getAskingPrice());

        // Create the seat form
        $this->seatForm = new SeatsRequestForm($this->seat);
    }
}
