<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> is traveling your way! Based 
    on your trip details, we think the two of you might want to ride together.
</p>

<p>The recommendation is:</p>

<p>
    From <?php echo $seat->getRoutes()->getOriginString(); ?> <br />
    To <?php echo $seat->getRoutes()->getDestinationString(); ?> <br />
    On <?php echo format_date($seat->getPickupDate(), 'P'); ?>
</p>

<p>You can view the full details of the recommendation at <a href="<?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>"><?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?></a></p>

<p>If the match looks good, go ahead and start discussing the important details. If you are not interested in beginning the discussion, you can hide the recommendation.</p>

<p>Thanks for riding with Rootless,</p>

<p>The Rootless Team</p>