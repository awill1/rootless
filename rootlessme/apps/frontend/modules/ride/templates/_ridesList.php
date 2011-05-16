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
        <?php foreach ($carpools as $i => $carpool): ?>
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
            <td><?php echo $carpool->getOriginLocation()->getCityStateString() ?></td>
            <td>to</td>
            <td><?php echo $carpool->getDestinationLocation()->getCityStateString() ?></td>
            <td>
                <a href="<?php echo url_for("profile_show_user", $carpool->getPeople()->getProfiles()->getFirst()) ?>">
                    <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $carpool->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $carpool->getPeople() ?>" /> <?php echo $carpool->getPeople() ?>
                </a>
            </td>
            <td><a href="<?php echo url_for("ride_offer",$carpool) ?>">Offer</a></td>
            <td><?php echo $carpool->getSeatsAvailable() ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
