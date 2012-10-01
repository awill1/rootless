<p>Hi <?php echo $reader->getFirstName(); ?>,</p>

<p><?php echo $otherUser->getFullName(); ?> has accepted the terms from <?php echo $seat->getRoutes()->getOriginString(); ?> to <?php echo $seat->getRoutes()->getDestinationString(); ?> on <?php echo $seat->getPickupDate(); ?> at <?php echo $seat->getPickupTime(); ?>!</p>

<p>You can view the terms at <a href="%LINK%">%LINK%</a></p>

<p>Now that your terms have been accepted, what next?</p>

<p>Make sure to contact the person with any remaining questions you may have. You may want to contact the person on their phone to arrange the final details.</p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>