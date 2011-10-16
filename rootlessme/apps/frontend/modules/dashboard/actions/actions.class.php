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

            // Get the confirmed passenger in all carpools the user is
            // riding in or driving
            $this->relatedPassengers = Doctrine_Core::getTable('Passengers')->getConfirmedPassengersForPerson($userPersonId);
        }
    }
}
