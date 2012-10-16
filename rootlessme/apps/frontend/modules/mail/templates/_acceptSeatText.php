<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has accepted the terms for the ride:

From <?php echo $seat->getRoutes()->getOriginString(); ?>
To <?php echo $seat->getRoutes()->getDestinationString(); ?>
On <?php echo format_date($seat->getPickupDate(), 'P'); ?>

You can view the full terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Now that your terms have been accepted, what next?

Make sure to contact the person with any remaining questions you may have. We recommend you arrange the final details over a phone call.

Thanks for riding with Rootless,

The Rootless Team