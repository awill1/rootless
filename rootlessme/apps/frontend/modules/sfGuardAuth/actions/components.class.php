<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../../../../../plugins/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthComponents.class.php');

/**
 * The components for the sfGuardAuth module
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: components.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthComponents extends BasesfGuardAuthComponents
{
    
    /**
     * Executes the ajax signin dialog action
     * @param sfWebRequest $request The web request
     */
    public function executeAjaxSigninDialog(sfWebRequest $request)
    {
        $this->testString = 'YEAH!';
        
        // Get the signin form
        $signinClass = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->signinForm = new $signinClass();
        
        // Get the registration form
        $this->registerForm = new sfGuardRegisterForm();
    }
}