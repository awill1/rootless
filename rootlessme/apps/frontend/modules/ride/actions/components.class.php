<?php

class rideComponents extends sfComponents
{
    public function executeShowOffer(sfWebRequest $request)
    {
        // Get the ride id
        $this->rideId = $request->getParameter('ride_id');

        // Get the users id
        $this->myUserId = null;
        if ($this->getUser()->isAuthenticated())
        {
            $this->myUserId = $this->getUser()->getGuardUser()->getPersonId();
        }

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

        // Check to see if the post belongs to the user
        $this->isMyPost = false;
        if ($this->myUserId == $this->carpool->getDriverId())
        {
            $this->isMyPost = true;
        }

        // Get the seats for this carpool
        $this->seats = Doctrine_Core::getTable('Seats')->getSeatsWithProfilesForCarpool($this->rideId);

        // Sort the seats into statuses and see if any of the seats are mine
        $this->acceptedSeats = new Doctrine_Collection('Seats');
        $this->pendingSeats = new Doctrine_Collection('Seats');
        $this->declinedSeats = new Doctrine_Collection('Seats');
        $this->mySeat = null;
        foreach ($this->seats as $seat)
        {
            $seatStatus = strtolower($seat->getSeatStatuses()->getDisplayText());
            switch ($seatStatus) {
                case 'pending':
                    $this->pendingSeats[] = $seat;
                    break;
                case 'accepted':
                    $this->acceptedSeats[] = $seat;
                    break;
                case 'declined':
                    $this->declinedSeats[] = $seat;
                    break;
            }

            // See if the seat belongs to the logged in user
            if ($seat->getPassengers()->getPersonId() == $this->myUserId)
            {
                // This is my seat so make note of it for the negotiation
                // partial
                $this->mySeat = $seat;
            }
        }
    }

    public function executeShowRequest(sfWebRequest $request)
    {
        // Get the ride id
        $this->rideId = $request->getParameter('ride_id');

        // Get the users id
        $this->myUserId = null;
        if ($this->getUser()->isAuthenticated())
        {
            $this->myUserId = $this->getUser()->getGuardUser()->getPersonId();
        }

        // Get the request information based on the ride id
        $this->passenger = Doctrine_Core::getTable('Passengers')->find(array($this->rideId));
        // Forward to 404 if the carpool is not found
        if (!$this->passenger)
        {
            throw new sfError404Exception('Passenger '.$this->rideId.' was not found.');
        }
        $this->passengerRoute = $this->passenger->getRoutes();
        $this->origin = $this->passengerRoute->getOriginLocation();
        $this->destination = $this->passengerRoute->getDestinationLocation();
        $this->rider = $this->passenger->getPeople()->getProfiles()->getFirst();

        // Check to see if the post belongs to the user
        $this->isMyPost = false;
        if ($this->myUserId == $this->passenger->getPersonId())
        {
            $this->isMyPost = true;
        }

        // Get the seats for this passenger post
        $this->seats = Doctrine_Core::getTable('Seats')->getSeatsWithProfilesForPassenger($this->rideId);

        // Sort the seats into statuses and see if any of the seats are mine
        $this->acceptedSeats = new Doctrine_Collection('Seats');
        $this->pendingSeats = new Doctrine_Collection('Seats');
        $this->declinedSeats = new Doctrine_Collection('Seats');
        $this->mySeat = null;
        foreach ($this->seats as $seat)
        {
            $seatStatus = strtolower($seat->getSeatStatuses()->getDisplayText());
            switch ($seatStatus) {
                case 'pending':
                    $this->pendingSeats[] = $seat;
                    break;
                case 'accepted':
                    $this->acceptedSeats[] = $seat;
                    break;
                case 'declined':
                    $this->declinedSeats[] = $seat;
                    break;
            }

            // See if the seat belongs to the logged in user
            if ($seat->getCarpools()->getDriverId() == $this->myUserId)
            {
                // This is my seat so make note of it for the negotiation
                // partial
                $this->mySeat = $seat;
            }
        }
    }
}
