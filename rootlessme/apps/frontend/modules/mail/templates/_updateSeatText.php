<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has changed the terms of the ride:

From <?php echo $seat->getRoutes()->getOriginString(); ?> 
To <?php echo $seat->getRoutes()->getDestinationString(); ?> 
On <?php echo format_date($seat->getPickupDate(), 'P'); ?> 

You can view the new terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Please check out the new terms and accept, decline, or make more changes.

Thanks for riding with Rootless,

The Rootless Team