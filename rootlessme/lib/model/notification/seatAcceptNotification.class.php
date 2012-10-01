<?php

/**
 * The notification created when a user accepts a seat.
 *
 * @author awilliams
 */
class seatAcceptNotification extends userNotification 
{
    const EMAIL_HTML_PARTIAL = 'mail/acceptSeatHtml';
    const EMAIL_TEXT_PARTIAL = 'mail/acceptSeatText';
    const NOTIFICATION_SLUG = 'SEAT_ACCEPTED_NOTIFICATION';
    
    /**
     * The accepted seat
     * @var Seats The accepted seat
     */
    protected $seat;
    
    /**
     * The person's profile who will receive the notification
     * @var Profiles The person's profile who will receive the notification
     */
    protected $reader;
    
    /**
     * The person who accepted the seat.
     * @var Profiles The person who accepted the seat.
     */
    protected $otherUser;
    
    /**
     * Creates a new instance of the seatAcceptNotification.
     * @param Seats $seat
     * @param Profiles $reader
     * @param Profiles $otherUser
     */
    public function __construct($seat, $reader, $otherUser) {
        $this->seat = $seat;
        $this->reader = $reader;
        $this->otherUser = $otherUser;
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
        return seatAcceptNotification::EMAIL_HTML_PARTIAL;
    }
    
    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailTextPartialName() 
    {
        return seatAcceptNotification::EMAIL_TEXT_PARTIAL;
    }
    
    /**
     * Gets the parameter array to be passed into the email partial
     * @return Array The parameter array to be passed into the partial
     */
    protected function getEmailPartialParameters()
    {
        return array('seat' =>  $this->seat,
                     'reader' => $this->reader,
                     'otherUser' => $this->otherUser);
    }

    /**
     * Gets the subject line for the email notification
     * @return String The email subject.
     */
    protected function getEmailSubject()
    {
        return 'Rootless seat accepted by '.$this->otherUser->getFullName();
    }
}

?>
