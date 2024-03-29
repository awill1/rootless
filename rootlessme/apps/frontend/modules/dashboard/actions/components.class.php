<?php

class dashboardComponents extends sfComponents
{
    /**
     * Executes the seat list item component
     * @param sfWebRequest $request The web request
     */
    public function executeSeatListItem(sfWebRequest $request)
    {
        // Get input parameters
        $seat = $this->getVar('seat');
        $show = $this->getVar('show');
        
        // Determine which person related to the seat to show
        if ($show == 'driver')
        {
            // Show the driver
            $this->traveler = $seat->getCarpools()->getPeople()->getProfiles();
            // The ride posted by the driver is the passenger post
            $this->ridePost = $seat->getPassengers();
            $this->ridePostId = $this->ridePost->getPassengerId();
            $this->ridePostType = 'request';
        }
        else
        {
            // Show the passenger
            $this->traveler = $seat->getPassengers()->getPeople()->getProfiles();
            // The ride posted by the driver is the carpool post
            $this->ridePost = $seat->getCarpools();
            $this->ridePostId = $this->ridePost->getCarpoolId();
            $this->ridePostType = 'offer';
        }

        $this->seatRoute = $seat->getRoutes(); 
        $this->userId = $this->getUser()->getGuardUser()->getPersonId();
    }
    
    /**
     * Executes the traveling with component
     * @param sfWebRequest $request The web request
     */
    public function executeTravelingWith(sfWebRequest $request)
    {
        // Traveling with requires the user to be logged in
        if ($this->getUser()->isAuthenticated())
        {
            // Get the user's person id
            $userPersonId = $this->getUser()->getGuardUser()->getPersonId();

            // Get the confirmed passenger in all carpools the user is
            // riding in or driving            
            $this->travelingCompanions = Doctrine_Core::getTable('Profiles')->getTravelingWithProfiles($userPersonId);
            
        }
    }
}
