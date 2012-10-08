<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has accepted the terms for the ride:</p>

<p>
    From <?php echo $seat->getRoutes()->getOriginString(); ?>  <br />
    To <?php echo $seat->getRoutes()->getDestinationString(); ?> <br />
    On <?php echo format_date($seat->getPickupDate(), 'P'); ?>
</p>

<p>You can view the full terms at <a href="<?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?>"><?php echo url_for('ride_show', array('ride_id' => $rideId, 'ride_type' => $rideType), true).'#seat-'.$seat->getSeatId(); ?></a></p>

<p>Now that your terms have been accepted, what next?</p>

<p>Make sure to contact the person with any remaining questions you may have. We recommend you arrange the final details over a phone call.</p>

<p>Thanks for riding with Rootless,</p>

<p>The Rootless Team</p>