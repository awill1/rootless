<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has requested a ride from you! The request is from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!

You can view the terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Please respond to the offer promptly to accept, decline, or change the terms.

Thanks for using Rootless,

The Rootless Team