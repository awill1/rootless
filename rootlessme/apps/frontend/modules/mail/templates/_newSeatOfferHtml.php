<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has offered you a ride! The offer is from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!</p>

<p>You can view the terms at <a href="%LINK%">%LINK%</a></p>

<p>Please respond to the offer promptly to accept, decline, or change the terms.</p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>