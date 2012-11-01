<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

We have found a carpool match for you! Based on your trip details, we think the two of you might want to ride together.


The recommendation is:

<?php if ($rideType=='offer') {echo 'Passenger: ';} else {echo "Driver: ";} ?><?php echo $otherUserProfile->getFullName(); ?>
Phone: <?php echo $otherUserProfile->getFullName(); ?> 
Email: <?php echo $otherUserProfile->getFullName(); ?> 
Pick up Location: <?php echo $seat->getRoutes()->getOriginString(); ?>  
Drop off Location: <?php echo $seat->getRoutes()->getDestinationString(); ?> 
On: <?php echo format_date($seat->getPickupDate(), 'P'); ?> 

If the match looks good, go ahead and start discussing the important details with the person. 


Thanks for riding with Rootless,

The Rootless Team