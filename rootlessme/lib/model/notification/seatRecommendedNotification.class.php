<?php

/**
 * The notification created when a user has a seat recommended
 *
 * @author awilliams
 */
class seatRecommendedNotification extends userNotification 
{
    const EMAIL_HTML_PARTIAL = 'mail/recommendSeatHtml';
    const EMAIL_TEXT_PARTIAL = 'mail/recommendSeatText';
    const NOTIFICATION_SLUG = 'SEAT_RECOMMENDED_NOTIFICATION';
    
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
     * The other person who is involved with the seat.
     * @var People The person who is also involved with the seat.
     */
    protected $otherUser;
    
    /**
     * Creates a new instance of the seatRecommendedNotification.
     * @param Seats $seat The seat that was changed
     * @param People $subscriber The user who is subscribed to the notification
     * @param People $otherUser The other user involved in the seat
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
        return seatRecommendedNotification::NOTIFICATION_SLUG;
    }

    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailHtmlPartialName() 
    {
        return seatRecommendedNotification::EMAIL_HTML_PARTIAL;
    }
    
    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailTextPartialName() 
    {
        return seatRecommendedNotification::EMAIL_TEXT_PARTIAL;
    }
    
    /**
     * Gets the parameter array to be passed into the email partial
     * @return Array The parameter array to be passed into the partial
     */
    protected function getEmailPartialParameters()
    {
        $subscriberId = $this->subscriber->getPersonId();
        $ride = $this->seat->getMyRide($subscriberId);
        $rideId = $ride->getRideId();
        $rideType = $ride->getRideType();
        return array('seat' =>  $this->seat,
                     'subscriber' => $this->subscriber,
                     'otherUser' => $this->otherUser,
                     'rideId' => $rideId,
                     'rideType' => $rideType);
    }

    /**
     * Gets the subject line for the email notification
     * @return String The email subject.
     */
    protected function getEmailSubject()
    {
        return sprintf('You have a new ride recommendation!');
    }
}

?>
