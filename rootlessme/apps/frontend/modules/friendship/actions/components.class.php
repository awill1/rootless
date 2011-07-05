<?php

class friendshipComponents extends sfComponents
{
    public function executeRequestFriendshipButton(sfWebRequest $request)
    {
        // Get the person id of the person being displayed
        $personId = $this->person_id;

        // Create a variable to save the friendship status
        $this->showAddFriend = false;
        $this->showPendingText = false;
        $this->showRequestResponse = false;

        // Determine whether to show the request friendship button based on
        // the current friendship status.
        // Only check the status if the user is logged in
        if ($this->getUser()->isAuthenticated())
        {
            $myId = $this->getUser()->getGuardUser()->getPersonId();
            
            $friendshipStatus = Doctrine_Core::getTable('Friendships')->getFriendshipStatus($personId)->getFirst();
            
            // Depending on the friendship status decide what to display
            if ($friendshipStatus)
            {
                $friendshipStatusText = $friendshipStatus->getFriendshipStatuses()->getDisplayText();
                switch ($friendshipStatusText) {
                    case 'Accepted':
                        // Show nothing
                        break;
                    case 'Denied':
                        // Show nothing
                        break;
                    case 'Pending':
                        // There is a pending friend request
                        if ($myId == $friendshipStatus->getRequesteeId())
                        {
                            // If the user is the
                            // requestee, desplay the response button
                            $this->showRequestResponse = true;
                        }
                        else
                        {
                            // The user is the requestor, so just show the status
                            $this->showPendingText = true;
                        }
                        break;
                    default:
                        // There has been no friend activity, so show the
                        // Add as Friend button
                        $this->showAddFriend = true;
                        break;
                }
            }
            elseif ($personId != $myId)
            {
                // There was no friendship activity, and the person is not 
                // the user, so show the "Add as Friend" button
                $this->showAddFriend = true;
            }
        }

    }
}
