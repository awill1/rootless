<div class="quickBoxItem">
    <img class="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $traveler->getPictureUrlSmall(); ?>" alt="<?php echo $traveler->getFullName(); ?>" />
    <p class="quickBoxName"><?php echo $traveler->getFullName() ?></p>
    <p class="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
    <p class="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
    <p class="quickBoxStatus">Status: <?php echo ucfirst(Doctrine_Core::getTable('SeatStatuses')->getStatusString($seat->getSeatStatusId())) ?></p>
    <ul class="quickBoxButtonsList">
        <?php if ($seat->canAccept($userId)): ?>
            <li class="quickBoxButtonsListItem">
                <a class="quickBoxAcceptButton" href="<?php echo url_for('seats_accept') ?>">
                    <div class="hidden seatIdContainer" ><?php echo $seat->getSeatId() ?></div>
                    Accept
                </a>
            </li>
        <?php endif; ?>
        <?php if ($seat->canDecline($userId)): ?>
        <li class="quickBoxButtonsListItem">
            <a class="quickBoxDeclineButton" href="<?php echo url_for('seats_decline') ?>">
                <div class="hidden seatIdContainer" ><?php echo $seat->getSeatId() ?></div>
                Decline
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <div class="quickBoxRequest">
        <a class="quickBoxViewRequestButton" href="<?php echo url_for('ride_show', array('ride_type' => $ridePostType, 'ride_id' => $ridePostId )); ?>#seat-<?php echo $seat->getSeatId() ?>">view negotiation</a>
    </div>
</div>
