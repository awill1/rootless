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

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles(), sprintf('Object profile does not exist.'));

    // Create partial profile update forms
    $this->accountInfoForm = new ProfilesAccountInfoForm($profile);
    $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);
  } 

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles(), sprintf('Object profile does not exist.'));

    // Create partial profile update forms   
    $this->accountInfoForm = new ProfilesAccountInfoForm($profile);
    $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);

    // Which form to precess depends on the section submitted
    if ($section = 'account')
    {
        $this->processForm($request, $this->accountInfoForm);
    }
    if ($section = 'additional')
    {
        $this->processForm($request, $this->additionalInfoForm);
    }

    $this->setTemplate('edit');
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $profile->delete();

    $this->redirect('profile/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $profile = $form->save();

      $this->redirect('profile/edit?profile_name='.$profile->getProfileName());
    }
  }

}
