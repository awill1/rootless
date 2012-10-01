<?php

/**
 * seat actions.
 *
 * @package    RootlessMe
 * @subpackage seat
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seatActions extends sfActions
{
    /**
     * Executes the show action for a seat
     * @param sfWebRequest $request
     * @return type 
     */
    public function executeShow(sfWebRequest $request)
    {
        // Get the seat id from the request
        $seatId = $request->getParameter('seat_id');

        // Get the seat information
        $this->seat = Doctrine_Core::getTable('Seats')->getSeatWithCarpoolAndPassenger($seatId);

        // No seat was found so

        // Seats should only be displayed if the user is one of the people
        // involved in the ride
        if ($this->getUser()->isAuthenticated())
        {
            if ($this->getUser()->getGuardUser()->getPersonId() == $this->seat->getCarpools()->getDriverId())
            {
                $this->isMyPost = true;
            }
        }

        // If the request came from AJAX render the seat negotiation partial
        if ($request->isXmlHttpRequest())
        {
            return $this->renderPartial('seat/negotiation',
                                array('ride_type' => $this->jobs,
                                      'ride' => $this->jobs,
                                      'seat_id' => $this->seat->getSeatId()));
        }
    }

    /**
     * The action for showing the seat negotiation form and history
     * @param sfWebRequest $request The http request
     * @return string A rendered output if the request was an AJAX request
     */
    public function executeNegotiation(sfWebRequest $request)
    {
        // Get the seat id from the request
        $seatId = $request->getParameter('seat_id');

        // Get the seat information
        $this->seat = Doctrine_Core::getTable('Seats')->getSeatWithCarpoolAndPassenger($seatId);
        $this->forward404Unless($this->seat);

        // Seats should only be displayed if the user is one of the people
        // involved in the ride
        $this->isMySeat = false;
        if ($this->getUser()->isAuthenticated())
        {
            $myUserId = $this->getUser()->getGuardUser()->getPersonId();
            $this->myUserId = $myUserId;
            // Check to see if the user is the driver
            if ( $this->seat->getCarpools()->getDriverId() == $myUserId )
            {
                $this->isMySeat = true;
            }

            // Check to see if the user is the passenger
            if ($this->seat->getPassengers()->getPersonId() == $myUserId)
            {
                $this->isMySeat = true;
            }
        }
        // If the seat does not belong to the user they are unauthorized to
        // view this page
        $this->forward404If(!$this->isMySeat, 'Seat was not found.');

        // If the request came from AJAX render the seat negotiation partial
        if ($request->isXmlHttpRequest())
        {
            return $this->renderComponent('seat', 'negotiation', array(
                                                     'seat' => $this->seat));
        }
    }
    
    /**
     * The action for creating a seat request
     * @param sfWebRequest $request The web request
     * @return string Rendered html of the created seat.
     */
    public function executeRequestCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SeatsRequestForm();

        $seat = $this->processForm($request, $this->form);

        // If the request came from AJAX render the seat negotiation partial
        // with the new seat information
        if ($request->isXmlHttpRequest())
        {
            if ($seat != null)
            {
                return $this->renderComponent('seat','negotiation', array('seat' => $seat));
            }
            else
            {
                return $this->renderText('Seat was not created');
            }
        }
        else
        {
            $this->setTemplate('new');

            if ($seat != null)
            {
                // This is not an AJAX request so redirect to the show seat
                // page

                $this->redirect('seats_show', array('seat_id', $seat->getSeatId()));
            }
        }
    }
    
    /**
     * The action for creating a seat offer
     * @param sfWebRequest $request The web request
     * @return string Rendered html of the created seat.
     */
    public function executeOfferCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SeatsOfferForm();

        $seat = $this->processForm($request, $this->form);

        // If the request came from AJAX render the seat negotiation partial
        // with the new seat information
        if ($request->isXmlHttpRequest())
        {
            if ($seat != null)
            {
                return $this->renderComponent('seat','negotiation', array('seat' => $seat));
            }
            else
            {
                return $this->renderText('Seat was not created');
            }
        }
        else
        {
            $this->setTemplate('new');

            if ($seat != null)
            {
                // This is not an AJAX request so redirect to the show seat
                // page

                $this->redirect('seats_show', array('seat_id', $seat->getSeatId()));
            }
        }
    }

    /**
     * Executes the update action used in negotiation
     * @param sfWebRequest $request The http request
     * @return string Rendered html of the updated seat.
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));

        $this->form = new SeatsNegotiationForm($seat);

        $seat = $this->processForm($request, $this->form);

        // If the request came from AJAX render the seat negotiation history
        // partial with the updated seat information
        if ($request->isXmlHttpRequest())
        {
            if ($seat != null)
            {
                $lastSeatNegotiationDifference = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryDifferencesForSeat($seat->getSeatId());
                return $this->renderComponent('seat','negotiationItem', array('negotiationChange' => $lastSeatNegotiationDifference));
            }
            else
            {
                return $this->renderText('Seat was not updated');
            }
        }
        else
        {
            $this->setTemplate('edit');

            if ($seat != null)
            {
                // This is not an AJAX request so redirect to the show seat
                // page

                $this->redirect('seats_show', array('seat_id', $seat->getSeatId()));
            }
        }
    }


    /**
     * Executes the accept action in the seats module
     * @param sfWebRequest $request The web request
     */
    public function executeAccept(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
        
        // Get the format of the html to return after updating the seat
        $returnFormat = $request->getParameter('format', 'negotiation');

        // Accept the seat
        if ($this->getUser()->isAuthenticated())
        {
            $userId = $this->getUser()->getGuardUser()->getPersonId();

            // Make sure the user is allowed to accept the seat
            if ($seat->canAccept($userId))
            {
                // Change the seat status and save with history
                $seat->setSeatStatusId(SeatStatusesTable::$rideTypes['accepted']);
                $updatedSeat = $seat->saveWithHistory($userId);
                
                // Send a notification to the other user
                $userIsDriver = $seat->getCarpools()->getDriverId() == $userId;
                $userProfile = $this->getUser()->getGuardUser()->getPeople()->getProfiles();
                $otherProfile = NULL;
                if ($userIsDriver)
                {
                    $otherProfile = $seat->getPassengers()->getPeople()->getProfiles();
                }
                else
                {
                    $otherProfile = $seat->getCarpools()->getPeople()->getProfiles();
                }
                
                // Send out notifications
                $notification = new seatAcceptNotification($seat, $otherProfile, $userProfile);
                $notification->sendNotifications($this->getUser()->getGuardUser()->getPeople());

                // If the request came from AJAX render the seat negotiation history
                // partial with the updated seat information
                if ($request->isXmlHttpRequest())
                {
                    if ($seat != null)
                    {
                        $lastSeatNegotiationDifference = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryDifferencesForSeat($seat->getSeatId());
                        // Output the resulting seat in the desired format
                        switch ($returnFormat) 
                        {
                            case 'dashboard':
                                // Show the person related to the seat that is not the user
                                $show = 'passenger';
                                if ($seat->getPassengers()->getPersonId() == $userId)
                                {
                                    $show = 'driver';
                                }
                                return $this->renderComponent('dashboard', 'seatListItem', array('seat' => $seat , 'show' => $show));
                                break;
                            case 'negotiation':
                            default:
                                return $this->renderComponent('seat','negotiationItem', array('negotiationChange' => $lastSeatNegotiationDifference));
                                break;
                        }
                    }
                    else
                    {
                        return $this->renderText('Seat was not updated');
                    }
                }
            }
        }
    }

    /**
     * Executes the decline action in the seats module
     * @param sfWebRequest $request The web request
     */
    public function executeDecline(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
        
        // Get the format of the html to return after updating the seat
        $returnFormat = $request->getParameter('format', 'negotiation');
        
        // Decline the seat
        if ($this->getUser()->isAuthenticated())
        {
            $userId = $this->getUser()->getGuardUser()->getPersonId();

            // Make sure the user is allowed to decline the seat
            if ($seat->canDecline($userId))
            {
                // Change the seat status and save with history
                $seat->setSeatStatusId(SeatStatusesTable::$rideTypes['declined']);
                $updatedSeat = $seat->saveWithHistory($userId);

                // If the request came from AJAX render the seat negotiation history
                // partial with the updated seat information
                if ($request->isXmlHttpRequest())
                {
                    if ($seat != null)
                    {
                        $lastSeatNegotiationDifference = Doctrine_Core::getTable('SeatsHistory')->getLatestHistoryDifferencesForSeat($seat->getSeatId());
                        
                        // Output the resulting seat in the desired format
                        switch ($returnFormat) 
                        {
                            case 'dashboard':
                                // Show the person related to the seat that is not the user
                                $show = 'passenger';
                                if ($seat->getPassengers()->getPersonId() == $userId)
                                {
                                    $show = 'driver';
                                }
                                return $this->renderComponent('dashboard', 'seatListItem', array('seat' => $seat , 'show' => $show));
                                break;
                            case 'negotiation':
                            default:
                                return $this->renderComponent('seat','negotiationItem', array('negotiationChange' => $lastSeatNegotiationDifference));
                                break;
                        }
                    }
                    else
                    {
                        return $this->renderText('Seat was not updated');
                    }
                }
            }
        }
    }

    /**
     * Processes the seat form
     * @param sfWebRequest $request The http request
     * @param sfFormDoctrine $form The seat form
     * @param int $seatStatusId The seat status id to set on the seat
     * @return Seats The saved seat 
     */
    protected function processForm(sfWebRequest $request, sfFormDoctrine $form, $seatStatusId = 1)
    {
        // Bind the request to the form
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        // Set the seat status
        $seat = $form->getObject();
        $seat->setSeatStatusId($seatStatusId);
        
        // Process the form
        if ($form->isValid())
        {
            // Get the is new value since it will change after saving
            $isNew = $form->getObject()->isNew();

            // Only allow updates to seats if the user is logged in
            if ($this->getUser()->isAuthenticated())
            {
                $personId = $this->getUser()->getGuardUser()->getPersonId();

                // Save the seat
                $seat = $form->save();

                // Create the seat history entry
                $action = 'update';
                if ($isNew)
                {
                    // The seat is new so the action is create
                    $action = 'create';
                }
                $seatHistoryEntry = SeatsHistory::createHistoryFromSeat($seat, $personId, $action);

                // Save the history record
                $seatHistoryEntry = $seatHistoryEntry->save();
            }
            
            // Get the seat again since the route is not getting updated in the 
            // object
            $seat = Doctrine_Core::getTable('Seats')->find($seat->getSeatId());

            return $seat;
        }
        else
        {
            $this->logMessage('Form is not valid!', 'err');
            $this->logMessage($form->renderGlobalErrors(), 'err');
            $errors = $form->getErrorSchema()->getErrors();
            if (count($errors) > 0)
            {
                foreach ($errors as $name => $error)
                {
                    $this->logMessage($name . ': ' . $error, 'err');
                }
            }
        }
    }
}
