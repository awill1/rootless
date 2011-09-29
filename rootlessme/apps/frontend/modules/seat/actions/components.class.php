<?php

class seatComponents extends sfComponents
{
    public function executeNegotiation(sfWebRequest $request)
    {
        // Get the seat type and number from the request parameters
        $this->rideType = $this->getVar('ride_type');
        $this->ride = $this->getVar('ride');
        $this->seat = $this->getVar('seat');

        $this->seatTitle = 'Request a Seat';
        
        // Get my user id
        $myUserId = null;
        $this->isMyPost = false;
        if ($this->getUser()->isAuthenticated())
        {
            $myUserId = $this->getUser()->getGuardUser()->getPersonId();
        }
        
        // Form and seat needed for seat negotiation
        $this->form;

        // Seat behavior depends on if the seat already exists
        if ( $this->seat )
        {
            // Build the seat negotiation form based on the existing seat
            switch ($this->rideType) {
                case "offer":
                    // Create the seat form
                    $this->form = new SeatsRequestForm($this->seat);
                    break;
                case "request":
                    // Create the seat form
                    $this->form = new SeatsForm($this->seat);
                    break;
                default:
                   // Default case just in case the ride_type is invalid (should
                   // be prevented by routing.yml).
                   echo 'Ride Type '.$this->rideType.'is invalid.';
            }
            
        }
        else
        {
            // The seat does not exist yet so create a new seat and set some
            // known properties
            // Create the seat
            $this->seat = new Seats();
            // Set the default price to be the same as the ride price
            $this->seat->setPrice($this->ride->getAskingPrice());
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
                    // Create the seat form
                    $this->form = new SeatsRequestForm($this->seat);
                    break;
                case "request":
                    // The ride was an request so set the passenger field
                    $this->seat->setPassengers($this->ride);
                    // Set the default seat count
                    // The ride type was a request, so the default is as many seats
                    // as there were in the request
                    $this->seat->setSeatCount($this->ride->getPassengerCount());
                    // Create the seat form
                    $this->form = new SeatsForm($this->seat);
                    break;
                default:
                   // Default case just in case the ride_type is invalid (should
                   // be prevented by routing.yml).
                   echo 'Ride Type '.$this->rideType.'is invalid.';
            }

            // Hide the input field for the posting
            switch ($this->rideType) {
                case "offer":
                    // The ride was an offer and we already set the value, so
                    // hide the control
    //                $this->seatForm->getWidget('carpool_id')->setHidden('true');
    //                $this->seatForm->getWidget('carpool_id')->setOption('type', 'hidden');
                    break;
                case "request":
                    // The ride was a request and we already set the value, so
                    // hide the control
    //                $this->seatForm->getWidget('passenger_id')->setHidden('true');
    //                $this->seatForm->getWidget('carpool_id')->setOption('type', 'hidden');
                    break;
                default:
                   // Default case just in case the ride_type is invalid (should
                   // be prevented by routing.yml).
                   echo 'Ride Type '.$this->rideType.'is invalid.';
            }
        }

        // Check to see if this is my post
        switch ($this->rideType) {
            case "offer":
                // The ride was an offer so
                // check the driver
                if ($this->ride->getDriverId() == $myUserId)
                {
                    $this->isMyPost = true;
                }
                break;
            case "request":
                // The ride was a request , so
                // check the passenger
                if ($this->ride->getPeopleId() == $myUserId)
                {
                    $this->isMyPost = true;
                }
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
    }
    
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
        
        // Hide the input field for the posting
        switch ($this->rideType) {
            case "offer":
                // The ride was an offer and we already set the value, so
                // hide the control
//                $this->seatForm->getWidget('carpool_id')->setHidden('true');
//                $this->seatForm->getWidget('carpool_id')->setOption('type', 'hidden');
                break;
            case "request":
                // The ride was a request and we already set the value, so
                // hide the control
//                $this->seatForm->getWidget('passenger_id')->setHidden('true');
//                $this->seatForm->getWidget('carpool_id')->setOption('type', 'hidden');
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }
    }
}
