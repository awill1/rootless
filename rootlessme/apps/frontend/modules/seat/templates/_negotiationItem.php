<div>
    <p>
        <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $changer->getPictureUrlSmall() ?>" alt="<?php echo $changer->getFullName() ?>" />
        <?php echo $changer->getFullName() ?>
        changed
    </p>
    <ul>
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
            Pickup date to <?php echo $negotiation->getPickupDate() ?>
        </li>
        <li>
            Pickup time to <?php echo $negotiation->getPickupTime() ?>
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