<?php

/**
 * admin actions.
 *
 * @package    RootlessMe
 * @subpackage admin
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adminActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        // Security hack until better system is in place
        // Only admins can use this action. 
        $this->forward404If(!$this->getUser()->isAuthenticated());
        $this->forward404If(!SecurityHelpers::IsRootlessAdmin($this->getUser()->getGuardUser()->getEmailAddress()));
    }
    
    
    /**
     * Executes delete rides to expired events action
     *
     * @param sfRequest $request A request object
     */
    public function executeDeleteRidesToExpiredEvents(sfWebRequest $request)
    {
        // Security hack until better system is in place
        // Only admins can use this action. 
        $this->forward404If(!$this->getUser()->isAuthenticated());
        $this->forward404If(!SecurityHelpers::IsRootlessAdmin($this->getUser()->getGuardUser()->getEmailAddress()));
        
        // This action always returns json
        $this->setLayout(sfView::NONE);
        $this->getResponse()->setContentType('application/json');
        
        
    }
}
