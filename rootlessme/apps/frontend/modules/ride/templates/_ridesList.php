<?php 
     $ridesArray = array();
  
     foreach ($passengers as $key => $passenger) {
         CommonHelpers::combineObjectsIntoArray($passenger->getStartDate(), $passenger, $ridesArray);
	 }
		
	 foreach ($carpools as $key => $carpool) {
	     CommonHelpers::combineObjectsIntoArray($carpool->getStartDate(), $carpool, $ridesArray);
	 }
	 
	 if (isset($ridesArray[0])) {
	 	 $today = date('Y-m-d');
	 	 if(!isset($ridesArray[$today])) {
	 	 	$ridesArray[$today] = array();
		 }
	     foreach($ridesArray[0] as $key => $ride) {
	         CommonHelpers::addOpenEndedRidesToArray($ride, $ridesArray);
		 }
		 unset($ridesArray[0]);
	 }
	 
	 ksort($ridesArray);
	 
     foreach ($ridesArray as $key => $rides):
?> 
<table class="rideTable">
    <thead>
        <tr>
            <th><h2 class="dateHeader orange"><?php echo date("F j, Y", strtotime($key)); ?></h2></th>
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
		$seatCost = $ride->getAskingPrice() != '' ? '$' . $ride->getAskingPrice() . ' per seat' : 'price negotiable';
		$route = $ride->getRoutes();
    ?>
        <tr>
           <td class="person-td">
               <a class="tableLink hide" href="<?php echo url_for("ride_show",array('ride_id'=>$id, 'ride_type'=>$rideType)) ?>"></a>
               <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall(); ?>" alt="<?php echo $people ?>" />
               <span class="ride-table-name">
                   <?php echo $profile->getFirstName(); ?><br />
                   <?php echo $profile->getLastName(); ?><br />
               </span>
               <span class="icon <?php $rideType == 'offer'? print "driver": print "passenger" ?>"></span>
               <span id="ride-<?php if($rideType == 'offer') { echo 'carpool-';} else { echo 'passenger-';} echo $id; ?>" class="hidden routePolyline"><?php echo $route->getEncodedPolyline(); ?></span>
            </td>
            <td class="origin-td"><?php echo $route->getOriginString(); ?></td>
            <td><span class="icon destination-arrow"></span></td>
            <td class="destination-td"><?php echo $route->getDestinationString(); ?></td>
            <td>
            	<div class="seatContainer"><?php $seats = $seats != '' ? $seats : 1; echo "<h2 class='seatCount'>" . $seats . "</h2>" . "<span class='seatText'>seat"; if($seats != 1) { echo 's'; } echo $seatText. "</span>"; ?></div>
            	<div class="cost green"><?php echo $seatCost; ?></div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endforeach; ?>
<?php if ($carpools->count() == 0 && $passengers->count() == 0) : ?>
    <div class="noRide">
        <p>No rides matched your search, but all is not lost! Search again or post your ride!</p>
        <div class="options">
	        <a class="cta" href="<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>">Offer a ride</a> 
	        <span class='or'>or</span>
	        <a class="cta" href="<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>">Request a ride</a>
        </div>
    </div>
<?php else: ?>
    <div class="noRide">
    	<div class="options">
	        <a class="cta" href="<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>">Offer a ride</a> 
	        <span class='or'>or</span>
	        <a class="cta" href="<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>">Request a ride</a>
        </div>
        <p>Haven’t found what you are looking for? Post your ride!</p>
    </div>
<?php endif; ?>
