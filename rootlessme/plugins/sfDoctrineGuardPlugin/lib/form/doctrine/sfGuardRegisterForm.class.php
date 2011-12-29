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
        // Update the route
        $sfGuardUser = $this->getObject();
        
        // If the person id is not set it is a new user
        if ( !$sfGuardUser->getPersonId())
        {
            // Change the username to be the same as the email address
            $this->values['username'] = $this->values['email_address'];
            
            // Create a new person
            $person = new People();
            $person->save();
            $personId = $person->getPersonId();
            
            // Set the sfGuard people id to be the person created
            $sfGuardUser->setPersonId($personId);
            
            // Create a profile
            $profile = new Profiles();
            $profile->setPersonId($personId);
            // The profile id should be a UUID
            $profile->setProfileName(CommonHelpers::CreateSimpleUuid());
            $profile->setFirstName($this->values['first_name']);
            $profile->setLastName($this->values['last_name']);

            // Create a users object in the database
            $user = new Users();
            $user->setPersonId($personId);
            $user->setUserName($this->values['email_address']);
            //$user->setUserName($this->values['username']);
            $user->setEmail($this->values['email_address']);
            $user->setEncryptedPassword('JUNK');

            // Save the new profile and user
            $profile->save();
            $user->save();
        }

        // Save the new sfGuardUser
        return parent::doSave($con);
    }
}