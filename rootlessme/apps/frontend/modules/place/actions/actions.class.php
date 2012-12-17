<?php

/**
 * place actions.
 *
 * @package    RootlessMe
 * @subpackage place
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class placeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->places = Doctrine_Core::getTable('Places')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id')));
    $this->forward404Unless($this->place);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PlacesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PlacesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
    $this->form = new PlacesForm($place);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
    $this->form = new PlacesForm($place);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($place = Doctrine_Core::getTable('Places')->find(array($request->getParameter('place_id'))), sprintf('Object place does not exist (%s).', $request->getParameter('place_id')));
    $place->delete();

    $this->redirect('place/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $place = $form->save();

      $this->redirect('place/edit?place_id='.$place->getPlaceId());
    }
  }
}
