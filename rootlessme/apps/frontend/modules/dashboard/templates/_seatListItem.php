<?php $driver = $seat->getCarpools()->getPeople()->getProfiles();
      $seatRoute = $seat->getRoutes(); ?>
<div class="quickBoxItem">
    <img class="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlSmall(); ?>" />
    <p class="quickBoxName"><?php echo $driver->getFullName() ?></p>
    <p class="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
    <p class="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
    <p class="quickBoxStatus">Status: <?php echo ucfirst(Doctrine_Core::getTable('SeatStatuses')->getStatusString($seat->getSeatStatusId())) ?></p>
    <ul class="quickBoxButtonsList">
        <li class="quickBoxButtonsListItem">
            <a class="quickBoxAcceptButton" href="<?php echo url_for('seats_accept') ?>">
                <div class="hidden seatIdContainer" ><?php echo $seat->getSeatId() ?></div>
                Accept
            </a>
        </li>
        <li class="quickBoxButtonsListItem">
            <a class="quickBoxDeclineButton" href="<?php echo url_for('seats_decline') ?>">
                <div class="hidden seatIdContainer" ><?php echo $seat->getSeatId() ?></div>
                Decline
            </a>
        </li>
    </ul>
    <div class="quickBoxRequest">
        <a class="quickBoxViewRequestButton" href="/rides">view negotiation</a>
    </div>
</div>
