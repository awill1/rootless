<table id="rideTable">
    <thead>
        <tr >
            <th>Date</th>
            <th></th>
            <th>Origin</th>
            <th>&nbsp;</th>
            <th>Destination</th>
            <th>Creator</th>
            <th>Price</th>
            <th>Seats</th>
        </tr>
    </thead>
    <?php 
        $rides = array();
  
        foreach ($passengers as $key => $passenger) {
        	CommonHelpers::combineObjectsIntoArray($key, $passenger, $rides);
	    }
		
		foreach ($carpools as $key => $carpool) {
			CommonHelpers::combineObjectsIntoArray($key, $carpool, $rides);
		}

        foreach ($rides as $key => $ride) {
        	$id = $ride->getRideType() == 'offer' ? $ride->getCarpoolId() : $ride->getPassengerId();
    	    print $id . '<br />';
	    }
		
	?> 
    <tbody>
        <?php foreach ($carpools as $i => $carpool):
                  $route = $carpool->getRoutes(); ?>
        <tr>
            <td>
                <div class="dateBlockLarge">
                    <div class="dateBlockMonth">
                        <?php echo date("M",strtotime($carpool->getStartDate())) ?>
                    </div>
                    <div class="dateBlockDate">
                        <?php echo date("j",strtotime($carpool->getStartDate())) ?>
                    </div>
                    <div class="dateBlockTime">
                        <?php echo date("g:i A",strtotime($carpool->getStartTime())) ?>
                    </div>
                </div>
            </td>
            <td>
            	<span class="icon driver"></span>
                <a class="tableLink hide" href="<?php echo url_for("ride_show",array('ride_id'=>$carpool->getCarpoolId(), 'ride_type'=>'offer')) ?>">Offer</a>
                <span id="ride-carpool-<?php echo $carpool->getCarpoolId() ?>" class="hidden routePolyline"><?php echo $carpool->getRoutes()->getEncodedPolyline(); ?></span>
            </td>
            <td><?php echo $route->getOriginString() ?></td>
            <td><span class="icon destination-arrow"></span></td>
            <td><?php echo $route->getDestinationString() ?></td>
            <td>
                <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $carpool->getPeople()->getProfiles()->getPictureUrlSmall(); ?>" alt="<?php echo $carpool->getPeople() ?>" />
                <span class="ride-table-name">
                	<?php echo $carpool->getPeople()->getProfiles()->getFirstName(); ?><br />
                	<?php echo $carpool->getPeople()->getProfiles()->getLastName(); ?><br />
                </span>
            </td>
            <td><?php echo '$' . $carpool->getAskingPrice() ?></td>
            <td style="text-align:center;"><strong><?php echo $carpool->getSeatsAvailable() ?></strong></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($passengers as $i => $passenger): 
            $route = $passenger->getRoutes();
            // The line striping should continue from the carpools list
            $lineNumber = $i + count($carpools);?>
        <tr>
            <td>
                <div class="dateBlockLarge">
                    <div class="dateBlockMonth">
                        <?php echo date("M",strtotime($passenger->getStartDate())) ?>
                    </div>
                    <div class="dateBlockDate">
                        <?php echo date("j",strtotime($passenger->getStartDate())) ?>
                    </div>
                    <div class="dateBlockTime">
                        <?php echo date("g:i A",strtotime($passenger->getStartTime())) ?>
                    </div>
                </div>
            </td>
            <td>
            	<span class="icon passenger"></span>
                <a class="tableLink hide" href="<?php echo url_for("ride_show",array('ride_id'=>$passenger->getPassengerId(), 'ride_type'=>'request')) ?>">Request</a>
                <span id="ride-passenger-<?php echo $passenger->getPassengerId() ?>" class="hidden routePolyline"><?php echo $passenger->getRoutes()->getEncodedPolyline(); ?></span> 
            </td>
            <td><?php echo $route->getOriginString() ?></td>
            <td><span class="icon destination-arrow"></span></td>
            <td><?php echo $route->getDestinationString() ?></td>
            <td>
                <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPeople()->getProfiles()->getPictureUrlSmall(); ?>" alt="<?php echo $passenger->getPeople() ?>" />
                <span class="ride-table-name">
                    <?php echo $passenger->getPeople()->getProfiles()->getFirstName(); ?><br />
                    <?php echo $passenger->getPeople()->getProfiles()->getLastName(); ?>
                </span>
            </td>
            <td><?php echo '$' . $passenger->getAskingPrice() ?></td>
            <td  style="text-align:center;"><strong><?php echo $passenger->getPassengerCount() ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($carpools->count() == 0 && $passengers->count() == 0) : ?>
    <div>
        No rides matched your search, but all is not lost. 
        <a href="<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>">Offer a ride</a> 
        or 
        <a href="<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>">Request a ride</a>. 
        Then other people will be able to find you!
    </div>
<?php endif; ?>
