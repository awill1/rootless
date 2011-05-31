<?php

/**
 * review actions.
 *
 * @package    RootlessMe
 * @subpackage review
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reviewActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->reviews = Doctrine_Core::getTable('Reviews')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->review = $this->getRoute()->getObject();
    //$this->review = Doctrine_Core::getTable('Reviews')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->review);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ReviewsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ReviewsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($review = Doctrine_Core::getTable('Reviews')->find(array($request->getParameter('rating_id'))), sprintf('Object review does not exist (%s).', $request->getParameter('rating_id')));
    $this->form = new ReviewsForm($review);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($review = Doctrine_Core::getTable('Reviews')->find(array($request->getParameter('rating_id'))), sprintf('Object review does not exist (%s).', $request->getParameter('rating_id')));
    $this->form = new ReviewsForm($review);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($review = Doctrine_Core::getTable('Reviews')->find(array($request->getParameter('rating_id'))), sprintf('Object review does not exist (%s).', $request->getParameter('rating_id')));
    $review->delete();

    $this->redirect('review/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $review = $form->save();

      $this->redirect('review/edit?rating_id='.$review->getRatingId());
    }
  }
}
