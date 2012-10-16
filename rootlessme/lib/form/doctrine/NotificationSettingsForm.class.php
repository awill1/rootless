<?php

/**
 * NotificationSettings form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NotificationSettingsForm extends BaseNotificationSettingsForm
{
    public function configure()
    {
        // Change the wants email field to a chaeck box
        $this->setWidget('wants_email', new myOwnWidgetFormInputCheckbox(array(
                         'value_attribute_value' => '1')));
        $this->setValidator('wants_email', new sfValidatorBoolean(array('required'=>false)));
      
        // Only use some fields
        $this->useFields(array('wants_email'));
      
        // Disable CSRF protection because it is an embedded form
        $this->disableCSRFProtection();
    }
}
