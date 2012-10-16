<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has declined the terms for the ride:

From <?php echo $seat->getRoutes()->getOriginString(); ?> <br />
To <?php echo $seat->getRoutes()->getDestinationString(); ?> <br />
On <?php echo format_date($seat->getPickupDate(), 'P'); ?>

You can view the full terms at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

Sorry your terms have been declined, but don't let that get you down. Search and find new amazing people to travel with! <?php echo url_for('ride'); ?>

Thanks for riding with Rootless,

The Rootless Team