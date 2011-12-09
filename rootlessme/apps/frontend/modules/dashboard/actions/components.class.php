<?php

class dashboardComponents extends sfComponents
{
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
