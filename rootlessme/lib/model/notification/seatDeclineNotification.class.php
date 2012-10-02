<?php

/**
 * The notification created when a user declines a seat.
 *
 * @author awilliams
 */
class seatDeclineNotification extends userNotification 
{
    const EMAIL_HTML_PARTIAL = 'mail/declineSeatHtml';
    const EMAIL_TEXT_PARTIAL = 'mail/declineSeatText';
    const NOTIFICATION_SLUG = 'SEAT_DECLINED_NOTIFICATION';
    
    /**
     * The changed seat
     * @var Seats The changed seat
     */
    protected $seat;
    
    /**
     * The person's profile who is subscribed to the notification
     * @var People The person's profile who will receive the notification
     */
    protected $subscriber;
    
    /**
     * The person who changed the seat.
     * @var People The person who changed the seat.
     */
    protected $otherUser;
    
    /**
     * Creates a new instance of the seatDeclineNotification.
     * @param Seats $seat The seat that was changed
     * @param Profiles $subscriber The user who is subscribed to the notification
     * @param Profiles $otherUser The other user who took action on the seat
     */
    public function __construct($seat, $subscriber, $otherUser) {
        $this->seat = $seat;
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
        return seatDeclineNotification::NOTIFICATION_SLUG;
    }

    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailHtmlPartialName() 
    {
        return seatDeclineNotification::EMAIL_HTML_PARTIAL;
    }
    
    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailTextPartialName() 
    {
        return seatDeclineNotification::EMAIL_TEXT_PARTIAL;
    }
    
    /**
     * Gets the parameter array to be passed into the email partial
     * @return Array The parameter array to be passed into the partial
     */
    protected function getEmailPartialParameters()
    {
        return array('seat' =>  $this->seat,
                     'subscriber' => $this->subscriber,
                     'otherUser' => $this->otherUser);
    }

    /**
     * Gets the subject line for the email notification
     * @return String The email subject.
     */
    protected function getEmailSubject()
    {
        return 'Seat terms declined by '.$this->otherUser->getProfiles()->getFullName();
    }
}

?>
