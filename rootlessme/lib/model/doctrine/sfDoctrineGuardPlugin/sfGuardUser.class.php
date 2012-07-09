<?php

/**
 * sfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUser extends PluginsfGuardUser
{
    public function save(Doctrine_Connection $conn = null)
    {
        if ($this->isNew())
        {
            // Change the username to be the same as the email address
            $this->setUsername($this->getEmailAddress());
            
            // Create a new person
            $person = new People();
            $person->save();
            
            // Set the sfGuard people id to be the person created
            $this->setPeople($person);
            
            // Create a profile
            $profile = new Profiles();
            $profile->setPeople($person); 
            // The profile id should be a UUID
            $profile->setProfileName(CommonHelpers::CreateSimpleUuid());
            $profile->save();
        }
        
        // Save the user
        parent::save($conn);
    }
    
    /**
     * Sets the user data from facebook
     * @param type $facebook_user_profile 
     * @param Boolean True if the values should be overwritten, false if only
     * unset values should be set.
     */
    public function setUserDataFromFacebook($facebook_user_profile, $shouldOverwrite = false)
    {
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getEmailAddress()))
        {
            if (property_exists($facebook_user_profile, 'email')) 
            {
                $this->setEmailAddress($facebook_user_profile->email);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getPassword()))
        {
            // Set a temp password
            $this->setPassword(CommonHelpers::CreateSimpleUuid());
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getFirstName()))
        {
            if (property_exists($facebook_user_profile, 'first_name')) 
            {
                $this->setFirstName($facebook_user_profile->first_name);
            }
        }
        if ($shouldOverwrite || CommonHelpers::IsNullOrEmptyString($this->getLastName()))
        {
            if (property_exists($facebook_user_profile, 'last_name')) 
            {
                $this->setLastName($facebook_user_profile->last_name);
            }
        }
    }
    
    
}
