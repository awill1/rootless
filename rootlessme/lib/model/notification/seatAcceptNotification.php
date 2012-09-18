<?php

/**
 * Description of seatAcceptNotification
 *
 * @author awilliams
 */
class seatAcceptNotification extends userNotification 
{
    const TOKEN_USER_FIRST = '%USER_FIRST%';
    const TOKEN_USER_LAST = '%USER_LAST%';
    const TOKEN_USER_FULL = '%USER_FULL%';
    const TOKEN_OTHER_FIRST = '%OTHER_FIRST%';
    const TOKEN_OTHER_LAST = '%OTHER_LAST%';
    const TOKEN_OTHER_FULL = '%OTHER_FULL%';
    const TOKEN_SEAT_ID = '%SEAT_ID%';
    const TOKEN_SEAT_ORIGIN = '%SEAT_ORIGIN%';
    const TOKEN_SEAT_DESTINATION = '%SEAT_DESTINATION%';
    const TOKEN_SEAT_LINK = '%SEAT_LINK%';
    
    /**
     * 
     * @param Seats $seat
     * @param Profiles $acceptor
     * @param Profiles $otherUser
     */
    public function __construct($seat, $acceptor, $otherUser) {
        // Build the replacement variable list
        $this->replacementVariables[seatAcceptNotification::TOKEN_USER_FIRST] = $acceptor->getFirstName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_USER_LAST] = $acceptor->getLastName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_USER_FULL] = $acceptor->getFullName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_OTHER_FIRST] = $otherUser->getFirstName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_OTHER_LAST] = $otherUser->getLastName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_OTHER_FULL] = $otherUser->getFullName();
        $this->replacementVariables[seatAcceptNotification::TOKEN_SEAT_ID] = $seat->getSeatId();
        $route = $seat->getRoutes();
        $this->replacementVariables[seatAcceptNotification::TOKEN_SEAT_ORIGIN] = $route->getOriginString();
        $this->replacementVariables[seatAcceptNotification::TOKEN_SEAT_DESTINATION] = $route->getDestinationString();
    }

    protected function getMessageTemplate()
    {
        return 
'%USER_FIRST%,

%OTHER_FULL% accepted your seat negotiation! You are now set to ride together!

The final negotiated details can be seen at %SEAT_LINK%.

Please contact the other person before your trip begins to confirm all of the details.

Thanks,
The Rootless Team
';
    }

    protected function getSubjectTemplate()
    {
        return 'Rootless seat accepted by %OTHER_FULL%';
    }
}

?>
