<?php 
     $ridesArray = array();
  
     foreach ($passengers as $key => $passenger) {
         CommonHelpers::combineObjectsIntoArray($passenger->getStartDate(), $passenger, $ridesArray);
	 }
		
	 foreach ($carpools as $key => $carpool) {
	     CommonHelpers::combineObjectsIntoArray($carpool->getStartDate(), $carpool, $ridesArray);
	 }
     
     ksort($ridesArray);
     foreach ($ridesArray as $key => $rides):
?> 
<table class="rideTable">
    <thead>
        <tr>
            <th><h2><?php echo date("F j, Y", strtotime($key)); ?></h2></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rides as $i => $ride) : 
    	$people = $ride->getPeople();
		$profile = $people->getProfiles();
		$rideType = $ride->getRideType();
		$id = $rideType == 'offer' ? $ride->getCarpoolId() : $ride->getPassengerId();
		$seats = $rideType == 'offer' ? $ride->getSeatsAvailable() : $ride->getPassengerCount(); 
		$seatText = $rideType == 'offer' ? ' available' : ' requested';
		$route = $ride->getRoutes();
    ?>
        <tr>
           <td>
               <a class="tableLink hide" href="<?php echo url_for("ride_show",array('ride_id'=>$id, 'ride_type'=>$rideType)) ?>"></a>
               <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall(); ?>" alt="<?php echo $people ?>" />
               <span class="ride-table-name">
                   <?php echo $profile->getFirstName(); ?><br />
                   <?php echo $profile->getLastName(); ?><br />
               </span>
               <span class="icon <?php $rideType == 'offer'? print "driver": print "passenger" ?>"></span>
               <span id="ride-<?php if($rideType == 'offer') { echo 'carpool-';} else { echo 'passenger-';} echo $id; ?>" class="hidden routePolyline"><?php echo $route->getEncodedPolyline(); ?></span>
            </td>
            <td><?php echo $route->getOriginString(); ?></td>
            <td><span class="icon destination-arrow"></span></td>
            <td><?php echo $route->getDestinationString(); ?></td>
            <td>
            	<strong><?php echo $seats . " seat"; if($seats != 1) { echo 's'; } echo $seatText ?></strong>
            	<?php echo '$' . $ride->getAskingPrice() . ' per seat'; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endforeach; ?>
<?php if ($carpools->count() == 0 && $passengers->count() == 0) : ?>
    <div>
        No rides matched your search, but all is not lost. 
        <a href="<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>">Offer a ride</a> 
        or 
        <a href="<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>">Request a ride</a>. 
        Then other people will be able to find you!
    </div>
<?php endif; ?>
