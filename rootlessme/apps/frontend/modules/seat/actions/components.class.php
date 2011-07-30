<?php

class seatComponents extends sfComponents
{
    public function executeSeatForm(sfWebRequest $request)
    {

        // Get the seat type and set the value in the form

        //$this->seatType = $this->getRequestParameter('seat_type');
        $this->rideType = $this->getVar('ride_type');
        $this->ride = $this->getVar('ride');

        // Create the seat
        $this->seat = new Seats();
        // Set the seat type field in the seat form
        // Need to get the correct value from the database
        switch ($this->rideType) {
            case "offer":
                // The ride was an offer so set the carpool field
                $this->seat->setCarpools($this->ride);
                // Set the default seat count
                // The ride type was an offer, so the default is taking up just
                // 1 passenger seat
                $this->seat->setSeatCount(1);
                break;
            case "request":
                // The ride was an request so set the passenger field
                $this->seat->setPassengers($this->ride);
                // Set the default seat count
                // The ride type was a request, so the default is as many seats
                // as there were in the request
                $this->seat->setSeatCount($this->ride->getPassengerCount());
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }

        // Set the default price to be the same as the ride price
        $this->seat->setPrice($this->ride->getAskingPrice());
        

        // Create the seat form
        $this->seatForm = new SeatsForm($this->seat);
    }
}
