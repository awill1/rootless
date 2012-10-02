<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has declined the terms from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!</p>

<p>You can view the terms at <a href="%LINK%">%LINK%</a></p>

<p>Sorry your terms have been declined, but don't let that get you down, there may be others you can travel with.  Check out the search page to find new matches.</p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>