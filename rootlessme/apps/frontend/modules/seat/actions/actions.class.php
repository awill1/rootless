<?php

/**
 * seat actions.
 *
 * @package    RootlessMe
 * @subpackage seat
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seatActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->seats = Doctrine_Core::getTable('Seats')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id')));
    $this->forward404Unless($this->seat);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SeatsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SeatsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $this->form = new SeatsForm($seat);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $this->form = new SeatsForm($seat);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($seat = Doctrine_Core::getTable('Seats')->find(array($request->getParameter('seat_id'))), sprintf('Object seat does not exist (%s).', $request->getParameter('seat_id')));
    $seat->delete();

    $this->redirect('seat/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $seat = $form->save();

      $this->redirect('seat/edit?seat_id='.$seat->getSeatId());
    }
  }
}
