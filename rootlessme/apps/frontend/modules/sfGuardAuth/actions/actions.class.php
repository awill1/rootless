<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../../../../../plugins/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
    /**
     *Executes the ajax signin action
     * @param sfWebRequest $request the web request
     * @return String Result json
     */  
    public function executeAjaxSignin($request)
    {
        //Success variable and message
        $success = 'false';
        
        try 
        {
            // This action always returns json with no template
            $this->getResponse()->setContentType('application/json');
            $this->setLayout(sfView::NONE);
            
            $user = $this->getUser();
            
            // Is the user already logged in?
            if ($user->isAuthenticated())
            {
                // Set the response code to OK
                $this->getResponse()->setStatusCode('200');
                // Return the error json
                return $this->renderText('{ "success": true, "message": "" }');
            }

            $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin'); 
            $this->form = new $class();

            // This method is only valid for ajax calls
            if (!$request->isXmlHttpRequest())
            {
                throw new Exception('Request must be XHR.');
            }

            if ($request->isMethod('post'))
            {
                $this->form->bind($request->getParameter('signin'));
                if ($this->form->isValid())
                {
                    $values = $this->form->getValues(); 
                    $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);
                    
                    
                    // Set the response code to OK
                    $this->getResponse()->setStatusCode('200');
                    // Return the error json
                    return $this->renderText('{ "success": true, "message": "" }');

                    // always redirect to the referer
                    // or to a URL set in app.yml
                    // or to the homepage  
                    $signinUrl = $user->getReferer($request->getReferer());      
                    if (CommonHelpers::IsNullOrEmptyString($signinUrl))
                    {
                        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url');
                    }

                    return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
                }
                else
                {
                    throw new Exception('Login Failed');
                }
            }
            else
            {      
                // GET is not supported
                throw new Exception('GET is not supported.');
            }
        }
        catch (Exception $e)
        {
            // Log the error
            $this->logMessage($e->getMessage()."; ".$e->getTraceAsString(), 'err');
            // Set the error code
            $this->getResponse()->setStatusCode('500');
            // Return the error json
            return $this->renderText('{ "success": false, "message": "'.$e->getMessage().'" }');
        }
    }
}
