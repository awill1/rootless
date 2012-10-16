<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has requested a ride from you! 

The request is:

From <?php echo $seat->getRoutes()->getOriginString(); ?> 
To <?php echo $seat->getRoutes()->getDestinationString(); ?> 
On <?php echo format_date($seat->getPickupDate(), 'P'); ?>

You can view the full terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Please respond to the offer promptly to accept, decline, or change the terms.

Thanks for riding with Rootless,

The Rootless Team