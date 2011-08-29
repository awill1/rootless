<?php

class rideComponents extends sfComponents
{
    public function executeShowOffer(sfWebRequest $request)
    {
        // Get the ride id
        $this->rideId = $request->getParameter('ride_id');

        // Get the offer information based on the ride id
        $this->carpool = Doctrine_Core::getTable('Carpools')->find(array($this->rideId));
        // Forward to 404 if the carpool is not found
        if (!$this->carpool)
        {
            throw new sfError404Exception('Carpool '.$this->rideId.' was not found.');
        }
        $this->carpoolRoute = $this->carpool->getRoutes();
        $this->origin = $this->carpool->getOriginLocation();
        $this->destination = $this->carpool->getDestinationLocation();
        $this->driver = $this->carpool->getPeople()->getProfiles()->getFirst();

        // Get the confirmed seat information
//        $this->riders = $this->carpool->getSeats();
        $this->seats = Doctrine_Core::getTable('Seats')->getPassengersWithProfilesForCarpool($this->rideId);

    }

    public function executeShowRequest(sfWebRequest $request)
    {
        // Get the ride id
        $this->rideId = $request->getParameter('ride_id');

        // Get the request information based on the ride id
        $this->passenger = Doctrine_Core::getTable('Passengers')->find(array($this->rideId));
        // Forward to 404 if the passenger is not found
        if (!$this->passenger)
        {
            throw new sfError404Exception('Passenger '.$this->rideId.' was not found.');
        }
        $this->passengerRoute = $this->passenger->getRoutes();
        $this->origin = $this->passengerRoute->getOriginLocation();
        $this->destination = $this->passengerRoute->getDestinationLocation();
        $this->rider = $this->passenger->getPeople()->getProfiles()->getFirst();

    }
}
