<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has offered you a ride!</p>

<p>The offer is:</p>

<p>
From <?php echo $seat->getRoutes()->getOriginString(); ?> <br />
To <?php echo $seat->getRoutes()->getDestinationString(); ?> <br />
On <?php echo format_date($seat->getPickupDate(), 'P'); ?>
</p>

<p>You can view the full terms at <a href="<?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>"><?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?></a></p>

<p>Please respond to the offer promptly to accept, decline, or change the terms.</p>

<p>Thanks for riding with Rootless,</p>

<p>The Rootless Team</p>