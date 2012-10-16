<?php

/**
 * The notification created when a user offers a seat.
 *
 * @author awilliams
 */
class seatNewOfferNotification extends userNotification 
{
    const EMAIL_HTML_PARTIAL = 'mail/newSeatOfferHtml';
    const EMAIL_TEXT_PARTIAL = 'mail/newSeatOfferText';
    const NOTIFICATION_SLUG = 'SEAT_OFFERED_NOTIFICATION';
    
    /**
     * The seat
     * @var Seats The seat
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
     * Creates a new instance of the seatNewOfferNotification.
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
        return seatNewOfferNotification::NOTIFICATION_SLUG;
    }

    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailHtmlPartialName() 
    {
        return seatNewOfferNotification::EMAIL_HTML_PARTIAL;
    }
    
    /**
     * Gets the html email partial name
     * @return String The partial name
     */
    protected function getEmailTextPartialName() 
    {
        return seatNewOfferNotification::EMAIL_TEXT_PARTIAL;
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
        return sprintf('%s has offered you a ride!', 
                       $this->otherUser->getProfiles()->getFullName());
    }
}

?>
