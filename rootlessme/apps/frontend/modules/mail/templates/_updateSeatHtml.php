<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has changed the terms of your trip from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!</p>

<p>You can view the new terms at <a href="%LINK%">%LINK%</a></p>

<p>Please check out the new terms and accept, decline, or make changes.</p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>