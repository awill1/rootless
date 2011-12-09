<?php

/**
 * dashboard actions.
 *
 * @package    RootlessMe
 * @subpackage dashboard
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        // Dashboard operations require the user to be logged in
        if ($this->getUser()->isAuthenticated())
        {
            // Get the user's person id
            $userPersonId = $this->getUser()->getGuardUser()->getPersonId();
            
            // Get the user's rides, both carpools and passenger posts
            $this->carpools = Doctrine_Core::getTable('Carpools')->getCarpoolsForPerson($userPersonId);
            $this->passengers = Doctrine_Core::getTable('Passengers')->getPassengersForPerson($userPersonId);
            
            // Get all seats related to the user
            $this->seats = Doctrine_Core::getTable('Seats')->getSeatsForPerson($userPersonId);
            
            // Sort the seats
            $this->passengerSeats = new Doctrine_Collection('Seats');
            $this->driverSeats = new Doctrine_Collection('Seats');
            foreach ($this->seats as $seat)
            {
                if ($seat->getCarpools()->getDriverId() == $userPersonId)
                {
                    // The user is the driver in the seat request
                    $this->driverSeats[] = $seat;
                }
                else
                {
                    // The user is the passenger in the seat request
                    $this->passengerSeats[] = $seat;
                }
            }
        }
    }
}
