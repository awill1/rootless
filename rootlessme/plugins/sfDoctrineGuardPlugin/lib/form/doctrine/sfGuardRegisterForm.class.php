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
        $this->useFields(array(
            'first_name',
            'last_name',
            'email_address',
            'username',
            'password',
            'password_again'));
//
//        $this->setWidgets(array(
//      'id'               => new sfWidgetFormInputHidden(),
//      'person_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('People'), 'add_empty' => false)),
//      'first_name'       => new sfWidgetFormInputText(),
//      'last_name'        => new sfWidgetFormInputText(),
//      'email_address'    => new sfWidgetFormInputText(),
//      'username'         => new sfWidgetFormInputText(),
//      'algorithm'        => new sfWidgetFormInputText(),
//      'salt'             => new sfWidgetFormInputText(),
//      'password'         => new sfWidgetFormInputText(),
//      'is_active'        => new sfWidgetFormInputCheckbox(),
//      'is_super_admin'   => new sfWidgetFormInputCheckbox(),
//      'last_login'       => new sfWidgetFormDateTime(),
//      'created_at'       => new sfWidgetFormDateTime(),
//      'updated_at'       => new sfWidgetFormDateTime(),
//      'groups_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
//      'permissions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
//
//        unset($this['person_id']);
    }

    public function doSave($con = null)
    {
        // Update the route
        $sfGuardUser = $this->getObject();
        
        if ( !$sfGuardUser->getPersonId())
        {
            // Create a new person
            $person = new People();
            $person->save();
            $personId = $person->getPersonId();
            
            // Set the sfGuard people id to be the person created
            $sfGuardUser->setPersonId($personId);
            
            // Create a profile
            $profile = new Profiles();
            $profile->setPersonId($personId);
            $profile->setProfileName($this->values['username']);
            $profile->setFirstName($this->values['first_name']);
            $profile->setLastName($this->values['last_name']);

            // Create a users object in the database
            $user = new Users();
            $user->setPersonId($personId);
            $user->setUserName($this->values['username']);
            $user->setEmail($this->values['email']);
            $user->setEncryptedPassword('JUNK');


            
            // Save the new profile
            $profile->save();
        }

        // Save the new sfGuardUser
        return parent::doSave($con);
    }
}