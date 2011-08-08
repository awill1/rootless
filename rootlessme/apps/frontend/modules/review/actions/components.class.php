<?php

class reviewComponents extends sfComponents
{
    public function executeReviews(sfWebRequest $request)
    {
        $this->profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name')));
//        $this->forward404Unless($this->profile);
        $this->personID = $this->profile->getPersonID();

        $this->reviews = Doctrine_Core::getTable('Reviews')->getReviewsForPersonWithProfile($this->personID);

        // Create the review form using the details of the users
        $newReview = new Reviews();
        // Set the reviewee
        $newReview->setRevieweeId($this->personID);
        // Set the reviewer
        if ($this->getUser()->isAuthenticated())
        {
            $newReview->setReviewerId($this->getUser()->getGuardUser()->getPersonId());
        }
        $this->reviewForm = new ReviewsForm($newReview);
    }
}
