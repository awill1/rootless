<?php

/**
 * Abstract class for usernotifications. This class controls all notification
 * message types for a specific notification.
 *
 * @author awilliams
 */
abstract class userNotification 
{    
    /**
     * Sends notifications to a person
     */
    public function sendNotifications()
    {
        // Get the notification settings for the user for this notification
        // Fix this. Wants email should be false and it should be retrieved 
        // from the notification settings
        $wantsEmail = true;
        $wantsSms = false;
        $slug = $this->getNotificationSlug();
        $notificationSetting = Doctrine_Core::getTable('NotificationSettings')->getNotificationSettingForPerson($this->getSubscriber()->getPersonId(), $slug);
        
        if ($notificationSetting)
        {
            $wantsEmail = $notificationSetting->getWantsEmail();
        }
        
        // Send email notification if desirend
        if ($wantsEmail)
        {
            $this->sendEmailNotification();
        }
        
        // Send sms notification if desired
        // Not implemented yet
        
        // Send internal notification if desired
        // Not implemented yet
    }

    /**
     * Sends an email notification
     */
    protected function sendEmailNotification()
    {
        $emailPartials = array('text' => $this->getEmailTextPartialName(), 
                               'html' => $this->getEmailHtmlPartialName());
        $mailFrom = array('email' => sfConfig::get('app_sf_guard_plugin_default_from_email'),
                          'name' => sfConfig::get('app_sf_guard_plugin_default_from_name'));
        EmailHelpers::sendEmail($emailPartials, 
                                $this->getEmailPartialParameters(), 
                                $mailFrom, 
                                $this->getSubscriber()->getSfGuardUser()->getEmailAddress(), 
                                $this->getEmailSubject());
    }
    
    
    /**
     * Gets the subscriber of the notification
     */
    abstract protected function getSubscriber();
    
    /**
     * Gets the notification slug
     */
    abstract protected function getNotificationSlug();
    
    /**
     * Gets the email text partial name
     */
    abstract protected function getEmailTextPartialName();
    
    /**
     * Gets the email html partial name
     */
    abstract protected function getEmailHtmlPartialName();
    
    /**
     * Gets the email partial parameters
     */
    abstract protected function getEmailPartialParameters();
    
    /**
     * Gets the email subject
     */
    abstract protected function getEmailSubject();
}

?>
