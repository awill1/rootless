<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

Your ride from <?php echo $origin; ?> to <?php echo $destination; ?> on <?php echo $date; ?> at <?php echo $time; ?> has been posted!

<?php if (!is_null($recommendedPassengers) || !is_null($recommendedDrivers)) : ?>
We have found the following recommendations for you: 

<?php if (!is_null($recommendedPassengers)) : ?>
<?php foreach ($recommendedPassengers as $recommendedPassenger) :
     $recommendedPassengerProfile = $recommendedPassenger->getPassengers()->getPeople()->getProfiles();
     $recommendedPassengerUser = $recommendedPassenger->getPassengers()->getPeople()->getSfGuardUser();?>
     Passenger: <?php echo $recommendedPassengerProfile->getFullName(); ?> 
     Phone: <?php echo $recommendedPassengerProfile->getPhoneNumber(); ?> 
     Email: <?php echo $recommendedPassengerUser->getEmailAddress(); ?> 
     Pickup Location: <?php echo $recommendedPassenger->getRoutes()->getOriginAddress(); ?> 
     Dropoff Location: <?php echo $recommendedPassenger->getRoutes()->getDestinationAddress(); ?> 
     
<?php endforeach; ?>
<?php endif; ?>

<?php if (!is_null($recommendedDrivers)) : ?>
<?php foreach ($recommendedDrivers as $recommendedDriver) :
     $recommendedDriverProfile = $recommendedDriver->getCarpools()->getPeople()->getProfiles();
     $recommendedDriverUser = $recommendedDriver->getCarpools()->getPeople()->getSfGuardUser();?>
     Driver: <?php echo $recommendedDriverProfile->getFullName(); ?> 
     Phone: <?php echo $recommendedDriverProfile->getPhoneNumber(); ?>
     Email: <?php echo $recommendedDriverUser->getEmailAddress(); ?> 
     Pick up Location: <?php echo $recommendedDriver->getRoutes()->getOriginAddress(); ?> 
     Drop off Location: <?php echo $recommendedDriver->getRoutes()->getDestinationAddress(); ?> 
     
<?php endforeach; ?>
<?php endif; ?>

Please contact the matches directly using the provided contact information to finalize times and locations.

<?php endif; ?>
<?php if (is_null($recommendedPassengers) && is_null($recommendedDrivers)) : ?>

There are no recommendations yet. We will let you know when a good match enters our system, so check your inbox.

<?php endif; ?>

We will continue sending you matches as they are added into our system. If you have already arranged your carpool or would not like to continue receiving recommendation emails for this ride post, please click this link %CLOSE_LINK% to close the ride. 

Enjoy the ride!
The Rootless Team