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
    $this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $this->form = new ProfilesForm($profile);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profile = Doctrine_Core::getTable('Profiles')->find(array($request->getParameter('profile_name'))), sprintf('Object profile does not exist (%s).', $request->getParameter('profile_name')));
    $this->form = new ProfilesForm($profile);

    $this->processForm($request, $this->form);

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
