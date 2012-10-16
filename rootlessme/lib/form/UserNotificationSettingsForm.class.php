<?php

/**
 * User Notification Settings form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserNotificationSettingsForm extends BaseForm
{
    // Class variables
    protected
        $personId    = null;
  
    /**
     * Constructor.
     *
     * @param Integer $peopleId The people id of the user to show the settings
     * @see sfForm
     */
    public function __construct($personId, $defaults = array(), $options = array(), $CSRFSecret = null)
    {
        $this->personId = $personId;
        
        // Call the parent constructor
        parent::__construct($defaults, $options, $CSRFSecret);
    }
  
    public function configure()
    {
        // Get the user's list of notification settings
        $userNotificationSettings = Doctrine_Core::getTable('NotificationSettings')
                ->getNotificationSettingsForPerson($this->personId);
        
        // For each notification setting
        foreach ($userNotificationSettings as $userNotificationSetting) {
            // Get the notification info
            $notification = $userNotificationSetting->getNotifications();
            $notificationSlug = $notification->getSlug();
            
            // Embed the notification setting form
            $notificationSettingForm = new NotificationSettingsForm($userNotificationSetting);
            $this->embedForm($notificationSlug, $notificationSettingForm);
        }

        // Setup the name format
        $this->widgetSchema->setNameFormat('notificationSettings[%s]');
    }
    
    protected function doBind(array $values) {
        
        parent::doBind($values);
        
        // bind embedded forms
        foreach ($this->getEmbeddedForms() as $name => $embeddedForm) 
        {    
            if ($embeddedForm instanceof sfFormObject)
            {
                $embeddedForm->bind($values[$name]);
            }         
        }
    }
    
    public function save()
    {
        foreach ($this->getEmbeddedForms() as $name => $embeddedForm) 
        {    
            if ($embeddedForm instanceof sfFormObject)
            {
                // Manually go through and save the description settings
                $notificationSetting = Doctrine_Core::getTable('NotificationSettings')
                                        ->getNotificationSettingForPerson($this->personId, $name);
                $wantsEmail = $embeddedForm->getValue('wants_email');
                $notificationSetting->setWantsEmail($wantsEmail);
                $notificationSetting->save(); 
            }          
        }
        
        // Return the person whose notification settings where changed
        $person = Doctrine_Core::getTable('People')->find($this->personId);
        return $person;
        
    }
    
}
