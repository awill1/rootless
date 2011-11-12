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

    /**
     * Executes the create action
     * @param sfWebRequest $request The http request
     * @return string The created review rendered as html.
     */
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

    /**
     * Gets review graphs for a users's reviews
     * @param sfWebRequest $request The http request.
     * @return string The rendered html output for the review graphs
     */
    public function executeGraph(sfWebRequest $request)
    {
        $personId = $request->getParameter('id');
        $this->ratings = Doctrine_Core::getTable('Reviews')->getReviewsSummaryForPerson($personId);

        if (!$this->ratings)
        {
            return $this->renderText('No results.');
        }

        return $this->renderPartial('review/ratingGraphs', array('ratings' => $this->ratings));
    }

    /**
     * Processes and saves a review form
     * @param sfWebRequest $request The http request
     * @param sfForm $form The review form
     * @return Reviews The saved review if successful. Null if the save was not
     * successful.
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $review = null;
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $review = $form->save();
        }

        return $review;
    }
}
