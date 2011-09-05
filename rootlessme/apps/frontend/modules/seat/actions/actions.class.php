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
  public function executeIndex(sfWebRequest $request)
  {
    $this->seats = Doctrine_Core::getTable('Seats')
      ->createQuery('a')
      ->execute();
  }

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
            if ($this->getUser()->getGuardUser()->getPersonId() == $this->carpool->getDriverId())
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

    public function executeNegotiation(sfWebRequest $request)
    {
        // Get the seat id from the request
        $seatId = $request->getParameter('seat_id');
        $rideType = $request->getParameter('ride_type');

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

        // Get the information for the ride to pass to the partial
        switch ($rideType) {
            case "offer":
                // The ride was an offer so
                // the ride is the carpool
                $ride = $this->seat->getCarpools();
                break;
            case "request":
                // The ride was a request so
                // the ride is a passenger
                $ride = $this->seat->getPassengers();
                break;
            default:
               // Default case just in case the ride_type is invalid (should
               // be prevented by routing.yml).
               echo 'Ride Type '.$this->rideType.'is invalid.';
        }


        // If the request came from AJAX render the seat negotiation partial
        if ($request->isXmlHttpRequest())
        {
            return $this->renderComponent('seat', 'negotiation', array(
                                                     'ride_type' => $rideType,
                                                     'ride' => $ride,
                                                     'seat' => $this->seat));
        }
    }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SeatsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SeatsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $this->form = new SeatsForm($seat);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $this->form = new SeatsForm($seat);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $seat->delete();

    $this->redirect('seat/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $seat = $form->save();

      $this->redirect('seat/edit?seat_id='.$seat->getSeatId());
    }
  }
}
