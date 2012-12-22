<?php use_helper('Date');
      $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

We have found a carpool match for you! Based on your trip details, we think the two of you might want to ride together.


The recommendation is:

<?php if ($rideType=='offer') {echo 'Passenger: ';} else {echo "Driver: ";} ?><?php echo $otherUserProfile->getFullName(); ?> 
Pick up Location: <?php echo $seat->getRoutes()->getOriginString(); ?>  
Drop off Location: <?php echo $seat->getRoutes()->getDestinationString(); ?> 
On: <?php echo format_date($seat->getPickupDate(), 'P'); ?> 

If the match looks good, go ahead and start discussing the important details with the person. You can view and edit the full terms at <?php 
if($rideType=='offer')
{
    echo url_for('ride_show', array('ride_type' => $rideType,'ride_id' => $seat->getCarpoolId()), TRUE).'#seat-'.$seat->getSeatId();
}
else
{
    echo url_for('ride_show', array('ride_type' => $rideType,'ride_id' => $seat->getPassengerId()), TRUE).'#seat-'.$seat->getSeatId();
}
?> .

If you have already arranged your carpool, or you would no longer like to receive emails for this ride click this link to close the ride:
<?php 
        
if($rideType=='offer')
{
    echo url_for('ride_close', array('ride_type' => 'offer','ride_id' => $seat->getCarpoolId(),'hash' => $hash), TRUE) ;
}
else
{
    echo url_for('ride_close', array('ride_type' => 'request' ,'ride_id' => $seat->getPassengerId() ,'hash' => $hash), TRUE) ;
}
?>


Thanks for riding with Rootless,

The Rootless Team