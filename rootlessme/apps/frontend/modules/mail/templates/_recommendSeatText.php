<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> is traveling your way! Based on your trip details, we think the two of you might want to ride together.

The recommendation is:

From <?php echo $seat->getRoutes()->getOriginString(); ?> 
To <?php echo $seat->getRoutes()->getDestinationString(); ?> 
On <?php echo format_date($seat->getPickupDate(), 'P'); ?> 

You can view the full details of the recommendation at <?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>

If the match looks good, go ahead and start discussing the important details. If you are not interested in beginning the discussion, you can hide the recommendation.

Thanks for riding with Rootless,

The Rootless Team