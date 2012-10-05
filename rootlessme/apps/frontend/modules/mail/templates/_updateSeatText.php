<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has changed the terms of your trip from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!

You can view the new terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Please check out the new terms and accept, decline, or make changes.

Thanks for using Rootless,

The Rootless Team