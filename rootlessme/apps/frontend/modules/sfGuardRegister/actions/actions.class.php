<?php

require_once dirname(__FILE__).'/../../../../../plugins/sfDoctrineGuardPlugin/modules/sfGuardRegister/lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
    /**
     * Executes the ajax register action
     * @param sfWebRequest $request the web request
     * @return String Result json
     */  
    public function executeAjaxRegister($request)
    {        
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

            // This method is only valid for ajax calls
            if (!$request->isXmlHttpRequest())
            {
                throw new Exception('Request must be XHR.');
            }

            // Create the register form
            $this->form = new sfGuardRegisterForm();

            if ($request->isMethod('post'))
            {
                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid())
                {
                    $user = $this->form->save();
                    $this->getUser()->signIn($user);

                    // Set the response code to OK
                    $this->getResponse()->setStatusCode('200');
                    // Return the error json
                    return $this->renderText('{ "success": true, "message": "" }');
                }
                else
                {
                    // The registration was not valid. Get the error message.
                    $message = "";
                    foreach($this->form->getErrorSchema()->getErrors() as $e) 
                    {
                        $message .= ($e->__toString() . ' ');          
                    }
                    throw new Exception($message);
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