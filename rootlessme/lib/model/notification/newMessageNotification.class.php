<?php

/**
 * The notification created when a user recieves a message.
 *
 * @author awilliams
 */
class newMessageNotification extends userNotification 
{
    const EMAIL_HTML_PARTIAL = 'mail/newMessageHtml';
    const EMAIL_TEXT_PARTIAL = 'mail/newMessageText';
    const NOTIFICATION_SLUG = 'NEW_MESSAGE_NOTIFICATION';
    
    /**
     * The message
     * @var Messages The message
     */
    protected $message;
    
    /**
     * The person's profile who is subscribed to the notification
     * @var People The person's profile who will receive the notification
     */
    protected $subscriber;
    
    /**
     * The person who sent the message.
     * @var People The person who sent the message.
     */
    protected $otherUser;
    
    /**
     * Creates a new instance of the seatAcceptNotification.
     * @param Messages $message The message created
     * @param Profiles $subscriber The user who is subscribed to the notification
     * @param Profiles $otherUser The other user who took action on the seat
     */
    public function __construct($message, $subscriber, $otherUser) {
        $this->message = $message;
        $this->subscriber = $subscriber;
        $this->otherUser = $otherUser;
    }
    
    /**
     * Gets the person subscribed to this notification
     * @return People The subscriber
     */
    protected function getSubscriber() {
        return $this->subscriber;
    }

    /**
     * Gets the notification slug
     * @return String The notification slug
     */
    protected function getNotificationSlug() {
        return seatAcceptNotification::NOTIFICATION_SLUG;
    }

    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailHtmlPartialName() 
    {
        return newMessageNotification::EMAIL_HTML_PARTIAL;
    }
    
    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailTextPartialName() 
    {
        return newMessageNotification::EMAIL_TEXT_PARTIAL;
    }
    
    /**
     * Gets the parameter array to be passed into the email partial
     * @return Array The parameter array to be passed into the partial
     */
    protected function getEmailPartialParameters()
    {
        return array('message' =>  $this->message,
                     'subscriber' => $this->subscriber,
                     'otherUser' => $this->otherUser);
    }

    /**
     * Gets the subject line for the email notification
     * @return String The email subject.
     */
    protected function getEmailSubject()
    {
        return 'You have a message from '.$this->otherUser->getProfiles()->getFullName();
    }
}

?>
