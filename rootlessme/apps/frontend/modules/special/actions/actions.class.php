<?php

/**
 * special actions.
 *
 * @package    RootlessMe
 * @subpackage special
 * @author     rwells
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class specialActions extends sfActions
{
    /**
     * Executes patriots action
     *
     * @param sfRequest $request A request object
     */
    public function executePatriots(sfWebRequest $request)
    {

    }
  
    /**
     * Executes special events register action
     *
     * @param sfRequest $request A request object
     */
    public function executeRegister(sfWebRequest $request)
    {
        // Verify the request parameters
        
        
        // Send the email to contact at rootless.me
        
        
        // Return nothing to the page 
        $this->setLayout(sfView::NONE);
        return "";
    }
}
