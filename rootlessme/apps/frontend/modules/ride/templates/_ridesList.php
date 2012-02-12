<table id="rideTable">
    <thead>
        <tr >
            <th>Date</th>
            <th>Origin</th>
            <th>&nbsp;</th>
            <th>Destination</th>
            <th>Creator</th>
            <th>Type</th>
            <th># of Seats</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($carpools as $i => $carpool):
                  $route = $carpool->getRoutes(); ?>
        <tr class="<?php echo fmod($i, 2) ? 'rideListNotSelectedAltRow' : 'rideListNotSelectedRow' ?>">
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
            <td><?php echo $route->getOriginString() ?></td>
            <td>to</td>
            <td><?php echo $route->getDestinationString() ?></td>
            <td>
                <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $carpool->getPeople()->getProfiles()->getPictureUrlSmall(); ?>" alt="<?php echo $carpool->getPeople() ?>" />
                <?php echo $carpool->getPeople() ?>
            </td>
            <td>
                <a class="tableLink" href="<?php echo url_for("ride_show",array('ride_id'=>$carpool->getCarpoolId(), 'ride_type'=>'offer')) ?>">Offer</a>
                <span id="ride-carpool-<?php echo $carpool->getCarpoolId() ?>" class="hidden routePolyline"><?php echo $carpool->getRoutes()->getEncodedPolyline(); ?></span>
            </td>
            <td><?php echo $carpool->getSeatsAvailable() ?></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($passengers as $i => $passenger): 
            $route = $passenger->getRoutes();
            // The line striping should continue from the carpools list
            $lineNumber = $i + count($carpools);?>
        <tr class="<?php echo fmod($lineNumber, 2) ? 'rideListNotSelectedAltRow' : 'rideListNotSelectedRow' ?>">
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
            <td><?php echo $route->getOriginString() ?></td>
            <td>to</td>
            <td><?php echo $route->getDestinationString() ?></td>
            <td>
                <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPeople()->getProfiles()->getPictureUrlSmall(); ?>" alt="<?php echo $passenger->getPeople() ?>" />
                <?php echo $passenger->getPeople() ?>
            </td>
            <td>
                <a class="tableLink" href="<?php echo url_for("ride_show",array('ride_id'=>$passenger->getPassengerId(), 'ride_type'=>'request')) ?>">Request</a>
                <span id="ride-passenger-<?php echo $passenger->getPassengerId() ?>" class="hidden routePolyline"><?php echo $passenger->getRoutes()->getEncodedPolyline(); ?></span> 
            </td>
            <td><?php echo $passenger->getPassengerCount() ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
