<hr />
<h3>Negotiations</h3>
<div id="seatNegotiationHistoryList">
    <?php foreach ($negotiations as $negotiation):
              $changer = $negotiation->getPeople()->getProfiles()->getFirst();
              $route = $negotiation->getRoutes(); ?>
    <div class="seatNegotiationHistoryItem">
        <p>
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $changer->getPictureUrlSmall() ?>" alt="<?php echo $changer->getFullName() ?>" />
            <?php echo $changer->getFullName() ?>
            changed
        </p>
        <ul>
            <li>
                Pickup location to <?php echo $route->getOriginLocation()->getName() ?>
            </li>
            <li>
                Dropoff location to <?php echo $route->getDestinationLocation()->getName() ?>
            </li>
            <li>
                Seat status to <?php echo $negotiation->getSeatStatusId() ?>
            </li>
            <li>
                Price to $<?php echo $negotiation->getPrice() ?>
            </li>
            <li>
                Seat count to <?php echo $negotiation->getSeatCount() ?>
            </li>
            <li>
                Pickup date to <?php echo date("m/d/Y",strtotime($negotiation->getPickupDate())) ?>
            </li>
            <li>
                Pickup time to <?php echo date("g:i A",strtotime($negotiation->getPickupTime())) ?>
            </li>
            <li>
                Description to <?php echo $negotiation->getDescription() ?>
            </li>
            <li>
                Updated <?php echo $negotiation->getCreatedAt() ?>
            </li>
        </ul>
        <hr />
    </div>
    <?php endforeach; ?>
</div>
