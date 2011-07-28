<?php

/**
 * static actions.
 *
 * @package    RootlessMe
 * @subpackage static
 * @author     awilliams
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class staticActions extends sfActions
{
    /**
     * Executes about action
     *
     * @param sfRequest $request A request object
     */
    public function executeAbout(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }
    
    /**
     * Executes contact action
     *
     * @param sfRequest $request A request object
     */
    public function executeContact(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }


    /**
     * Executes help action
     *
     * @param sfRequest $request A request object
     */
    public function executeHelp(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    /**
     * Executes home action
     *
     * @param sfRequest $request A request object
     */
    public function executeHome(sfWebRequest $request)
    {
        // Get the signin form
        $signinClass = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->signinForm = new $signinClass();

        // Get the registration form
        $this->registerForm = new sfGuardRegisterForm();
    }

    /**
     * Executes privacy action
     *
     * @param sfRequest $request A request object
     */
    public function executePrivacy(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    /**
     * Executes safety action
     *
     * @param sfRequest $request A request object
     */
    public function executeSafety(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    /**
     * Executes terms of service action
     *
     * @param sfRequest $request A request object
     */
    public function executeTerms(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

}
