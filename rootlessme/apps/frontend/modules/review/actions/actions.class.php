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

      $review = $this->processForm($request, $this->form);

      $this->setTemplate('new');

      if ($request->isXmlHttpRequest())
      {
          // This is an ajax request so return the new object
          if (!$review)
          {
            return $this->renderText('No new item.');
          }

          return $this->renderPartial('review/reviewListItem', array('review' => $review));
      }
      else
      {
        // Not an AJAX call so redirect to the new review page
        $this->redirect('review_show',$review);
      }
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

  public function executeGraph(sfWebRequest $request)
  {
    $personId = $request->getParameter('id');
    $this->ratings = Doctrine_Core::getTable('Reviews')->getReviewsSummaryForPerson($personId);
    
    // AJAX parts for rendering the new graphs
//    if ($request->isXmlHttpRequest())
//    {
        if (!$this->ratings)
        {
            return $this->renderText('No results.');
        }

        return $this->renderPartial('review/ratingGraphs', array('ratings' => $this->ratings));
//    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $review = $form->save();

      //$this->redirect('review/edit?rating_id='.$review->getRatingId());
    }

    return $review;
  }
}
