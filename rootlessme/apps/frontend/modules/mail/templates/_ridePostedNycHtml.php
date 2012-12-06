<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p>Your ride from <?php echo $origin; ?> to <?php echo $destination; ?> on <?php echo $date; ?> at <?php echo $time; ?> has been posted!</p>

<?php if (!is_null($recommendedPassengers) || !is_null($recommendedDrivers)) : ?>
<p>We have found the following recommendations for you: </p>

<?php if (!is_null($recommendedPassengers)) : ?>
<?php foreach ($recommendedPassengers as $recommendedPassenger) :
     $recommendedPassengerProfile = $recommendedPassenger->getPassengers()->getPeople()->getProfiles();
     $recommendedPassengerUser = $recommendedPassenger->getPassengers()->getPeople()->getSfGuardUser();?>
     <p>
     Passenger: <?php echo $recommendedPassengerProfile->getFullName(); ?> <br />
     Phone: <?php echo $recommendedPassengerProfile->getPhoneNumber(); ?> <br />
     Email: <?php echo $recommendedPassengerUser->getEmailAddress(); ?> <br />
     Pick up Location: <?php echo $recommendedPassenger->getRoutes()->getOriginAddress(); ?> <br />
     Drop off Location: <?php echo $recommendedPassenger->getRoutes()->getDestinationAddress(); ?>
     </p>
     
<?php endforeach; ?>
<?php endif; ?>

<?php if (!is_null($recommendedDrivers)) : ?>
<?php foreach ($recommendedDrivers as $recommendedDriver) :
     $recommendedDriverProfile = $recommendedDriver->getCarpools()->getPeople()->getProfiles();
     $recommendedDriverUser = $recommendedDriver->getCarpools()->getPeople()->getSfGuardUser();?>
     <p>
     Driver: <?php echo $recommendedDriverProfile->getFullName(); ?> <br />
     Phone: <?php echo $recommendedDriverProfile->getPhoneNumber(); ?><br />
     Email: <?php echo $recommendedDriverUser->getEmailAddress(); ?> <br />
     Pickup Location: <?php echo $recommendedDriver->getRoutes()->getOriginAddress(); ?> <br />
     Dropoff Location: <?php echo $recommendedDriver->getRoutes()->getDestinationAddress(); ?> 
     </p>
     
<?php endforeach; ?>
<?php endif; ?>

<p>Please contact the matches directly using the provided contact information to finalize times and locations.</p>

<?php endif; ?>
<?php if (is_null($recommendedPassengers) && is_null($recommendedDrivers)) : ?>

<p>There are no recommendations yet. We will let you know when a good match enters our system, so check your inbox.</p>

<?php endif; ?>

<p>We will continue sending you matches as they are added into our system. If you have already arranged your carpool or would not like to continue receiving recommendation emails for this ride post, please close the ride posts:

<?php 
        
if(!is_null($carpool))
{
    echo '<a href="'.url_for('ride_close', array('ride_type' => 'offer','ride_id' => $carpool->getCarpoolId(),'hash' => $hash), TRUE).'">'.url_for('ride_close', array('ride_type' => 'offer','ride_id' => $carpool->getCarpoolId(),'hash' => $hash), TRUE).'</a>';
    echo '<br />';
}
if(!is_null($passenger))
{
    echo '<a href="'.url_for('ride_close', array('ride_type' => 'request' ,'ride_id' => $passenger->getPassengerId() ,'hash' => $hash), TRUE).'">'.url_for('ride_close', array('ride_type' => 'request' ,'ride_id' => $passenger->getPassengerId() ,'hash' => $hash), TRUE).'</a>';
    echo '<br />';
}
?>
</p>
    
<p>Enjoy the ride!</p>
<p>The Rootless Team</p>