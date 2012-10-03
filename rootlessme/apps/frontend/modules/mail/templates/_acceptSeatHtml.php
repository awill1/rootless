<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has accepted the terms from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!</p>

<p>You can view the terms at <a href="<?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>"><?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?></a></p>

<p>Now that your terms have been accepted, what next?</p>

<p>Make sure to contact the person with any remaining questions you may have. You may want to contact the person on their phone to arrange the final details.</p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>