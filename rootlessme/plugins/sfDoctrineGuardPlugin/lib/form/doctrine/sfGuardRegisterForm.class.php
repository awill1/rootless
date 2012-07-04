<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
    /**
     * @see sfForm
     */
    public function configure()
    {
        // Hide the username field since it will be set to the email address
        $this->setWidget('username',new sfWidgetFormInputHidden());
        
        // Username is not required because it will be set to a UUID during
        // saving. Override the default validator.
        $this->setValidator('username',new sfValidatorString(array('max_length' => 128, 'required' => false)));
        
        $this->useFields(array(
            'first_name',
            'last_name',
            'email_address',
            'username',
            'password',
            'password_again'));

        // Change the label for password again to be "Confirm password"
        $this->widgetSchema->setLabel('password_again', 'Confirm password');
    }

    public function doSave($con = null)
    {
        // Save the new sfGuardUser
        parent::doSave($con);
        
        $sfGuardUser = $this->getObject();
        
        // Update the first and last name in the profile
        $profile =  $sfGuardUser->getPeople()->getProfiles();
        $profile->setFirstName($this->values['first_name']);
        $profile->setLastName($this->values['last_name']);
        $profile->save();
        
        return $sfGuardUser;
    }
}