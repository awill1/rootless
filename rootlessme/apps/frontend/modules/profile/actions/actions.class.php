<?php

/**
 * profile actions.
 *
 * @package    RootlessMe
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileActions extends sfActions
{
    /**
     * Executes the index action
     * @param sfWebRequest $request The http request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->profiles = Doctrine_Core::getTable('Profiles')
            ->getProfilesWithPictures(25);
    }

    /**
     * Executes the show action for a profile
     * @param sfWebRequest $request The http request
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name')));
        $this->forward404Unless($this->profile);
        $personID = $this->profile->getPersonID();

        // Get additional information needed for the profile show page
        $this->travelSummary = Doctrine_Core::getTable('Seats')->getTravelSummaryForPerson($personID);
        $this->vehicle = $this->profile->getPeople()->getVehicles()->getFirst();
        $this->ratings = Doctrine_Core::getTable('Reviews')->getReviewsSummaryForPerson($personID);
        $this->travelHistories = Doctrine_Core::getTable('Seats')->getTravelHistoryForPerson($personID);
        
        // Calculate the distance traveled
        $distanceTraveled = 0;
        foreach ($this->travelHistories as $travelHistory)
        {
            $distanceTraveled += $travelHistory->getRoutes()->getDistance();
        }
        $this->milesTraveled = $distanceTraveled * 0.000621371192;
        $this->kilometersTraveled = $distanceTraveled * .001;

        // Only allow reviews if the user is logged in
        if ($this->getUser()->isAuthenticated())
        {
            // Create the review form using the details of the users
            $newReview = new Reviews();
            // Set the reviewer
            $newReview->setReviewerId($personID);
            // Set the reviewee
            $newReview->setRevieweeId($this->getUser()->getGuardUser()->getPersonId());
            $this->reviewForm = new ReviewsForm($newReview);
        }
    }

    /**
     * Executes the edit action
     * @param sfWebRequest $request The http request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles(), sprintf('Object profile does not exist.'));

        // Create partial profile update forms
        $this->accountInfoForm = new ProfilesAccountInfoForm($profile);
        $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);
        $this->vehicleInfoForm = new VehiclesForm($profile->getPeople()->getVehicles()->getFirst());
        $this->sfGuardUserForm = new sfGuardUserAccountForm($profile->getPeople()->getSfGuardUser());
    } 

    /**
     * Executes the update action
     * @param sfWebRequest $request The http request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles(), sprintf('Object profile does not exist.'));

        // Get the section parameter
        $section = $request->getParameter('section');
        
        $profileForm = null;

        // Which form to precess depends on the section submitted
        if ($section == 'account')
        {
            $profileForm = new ProfilesAccountInfoForm($profile);
        }
        if ($section == 'additional')
        {
            $profileForm = new ProfilesAdditionalInfoForm($profile);
        }
        if ($section == 'password')
        {
            $profileForm = new sfGuardUserAccountForm($profile->getPeople()->getSfGuardUser());
        }
        
        // Save the changes to the profile
        $profile = $this->processForm($request, $profileForm);
        
        // If the request came from AJAX render the edit profile partial
        // with the new profile information
        if ($request->isXmlHttpRequest())
        {
            if ($profile != null)
            {
                // Create the form to be returned to the web page
                $profileForm = null;
                if ($section == 'account')
                {
                    $profileForm = new ProfilesAccountInfoForm($profile);
                }
                if ($section == 'additional')
                {
                    $profileForm = new ProfilesAdditionalInfoForm($profile);
                }
                if ($section == 'password')
                {
                    $profileForm = new sfGuardUserAccountForm($profile);
                }
                return $this->renderPartial('profile/form', array('form' => $profileForm, 'section' => $section));
            }
            else
            {
                return $this->renderPartial('profile/form', array('form' => $profileForm, 'section' => $section));
            }
        }
        else
        {
            // This is not an AJAX post so redirect back to the edit page
            $this->redirect('profile_edit_user', array('section' => $section));
        }
    }

    /**
     * Processes a profile form to create or update a profile
     * @param sfWebRequest $request The http request
     * @param sfForm $form The form
     * @return Profiles The profile that was saved
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $profile = $form->save();
            return $profile;
        }
    }
}
