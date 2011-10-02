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
    $this->vehicle = $this->profile->getPeople()->getVehicles()->getFirst();
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

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProfilesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProfilesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    //$this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles()->getFirst(), sprintf('Object profile does not exist.'));

    // The full profile form
    $this->form = new ProfilesForm($profile);

    // Create an additional information form
    $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);
    $this->accountInfoForm = new ProfilesAccountInfoForm($profile);
  } 

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    //$this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles()->getFirst(), sprintf('Object profile does not exist.'));
    $this->form = new ProfilesForm($profile);
    // Create an additional information form
    $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);   
    $this->accountInfoForm = new ProfilesAccountInfoForm($profile); 
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  
  public function executeUpdateAdditionalInfo(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    //$this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $this->forward404Unless($profile = $this->getUser()->getGuardUser()->getPeople()->getProfiles()->getFirst(), sprintf('Object profile does not exist.'));
    $this->form = new ProfilesForm($profile);
    // Create an additional information form
    $this->additionalInfoForm = new ProfilesAdditionalInfoForm($profile);   
    $this->accountInfoForm = new ProfilesAccountInfoForm($profile); 
    // Reuse the edit template
    $this->setTemplate('edit');
    // Process the additional form
    $this->processForm($request, $this->additionalInfoForm);

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
