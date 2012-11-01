<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p>We have found a carpool match for you! Based on your trip details, we think the two of you might want to ride together.
</p>

<p>The recommendation is:</p>

<p>
    <?php if ($rideType=='offer') {echo 'Passenger: ';} else {echo "Driver: ";} ?><?php echo $otherUserProfile->getFullName(); ?><br />
    Phone: <?php echo $otherUserProfile->getPhoneNumber(); ?><br />
    Email: <?php echo $otherUser->getSfGuardUser()->getEmailAddress(); ?><br />
    Pick up Location: <?php echo $seat->getRoutes()->getOriginString(); ?> <br />
    Drop off Location: <?php echo $seat->getRoutes()->getDestinationString(); ?> <br />
    On: <?php echo format_date($seat->getPickupDate(), 'P'); ?> 
</p>

<p>If the match looks good, go ahead and start discussing the important details with the person. </p>

<p>Thanks for riding with Rootless,</p>

<p>The Rootless Team</p>