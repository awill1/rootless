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
  public function executeIndex(sfWebRequest $request)
  {
    $this->profiles = Doctrine_Core::getTable('Profiles')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name')));
    $this->forward404Unless($this->profile);
    $personID = $this->profile->getPersonID();

    // Get additional information needed for the profile show page
    $this->friends = Doctrine_Core::getTable('Profiles')->getFriendsProfiles($personID);
    $this->travelSummary = Doctrine_Core::getTable('Seats')->getTravelSummaryForPerson($personID);
    $this->vehicle = $this->profile->getPeople()->getVehicles();
    $this->ratings = Doctrine_Core::getTable('Reviews')->getReviewsSummaryForPerson($personID);

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

        // Only get mutual friends if the user is logged in
        $this->mutualFriends = Doctrine_Core::getTable('Profiles')->getMutualFriendsProfiles($personID, $this->getUser()->getGuardUser()->getPersonId());

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
        
        $profile = $this->processForm($request, $profileForm);
        
        // If the request came from AJAX render the edit profile partial
        // with the new profile information
        if ($request->isXmlHttpRequest())
        {
            if ($profile != null)
            {
                $profileForm = null;
                if ($section == 'account')
                {
                    $profileForm = new ProfilesAccountInfoForm($profile);
                }
                if ($section == 'additional')
                {
                    $profileForm = new ProfilesAdditionalInfoForm($profile);
                }
                return $this->renderPartial('profile/form', array('form' => $profileForm, 'section' => $section));
            }
            else
            {
                return $this->renderText('Profile was not updated');
            }
        }
        else
        {
            $this->setTemplate('edit');

            if ($profile != null)
            {
                // This is not an AJAX request so redirect to the show seat
                // page

                $this->redirect('profile_edit', array('profile_name', $profile->getProfileName(), 'section' => $section));
            }
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
        }
        return $profile;
    }
}
