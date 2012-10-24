<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>
<script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatDetailsBlock" title="Seat details">
    <div id='seatNegotiationContainer'>
    
    <div id="seatInfo">
        <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $otherPersonProfile)  ?>">
                    <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $otherPersonProfile->getPictureUrlLarge() ?>" alt="<?php echo $otherPersonProfile->getFullName() ?>" />
                    <h3 class="postedByStyles">Posted By: <span class="green"><?php echo $otherPersonProfile->getFullName() ?></span></h3>
        </a>
        
        <div id="seatTerms">
            <h4>Ride Details</h4>
            <p><?php echo nl2br($seat->getDescription()) ?></p>
            <p><span>Start date:</span> <?php echo date("F",strtotime($seat->getStartDate())) ?> <?php echo date("j",strtotime($seat->getStartDate())) ?> at <?php echo date("g:i A",strtotime($seat->getStartTime())) ?></p>
            <p><span>Price:</span> $<?php echo $seat->getAskingPrice() ?> per seat</p>
            <p><span>Number of seats:</span> <?php echo $seat->getSeatsAvailable() ?></p>
            <script type="text/javascript">
            window.alert("You message goes here!")
            </script>
        </div>
        <div id="seatHistoryToggle">See Discussion History</div>
        <div id="seatButtons">
            <?php $canEdit = 1; ?>
            <?php if ($canAccept) : ?>
                <form id="seatAcceptForm" action="<?php echo url_for('seats_accept') ?>" method="post">
                    <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                    <input id="acceptButton" type="submit" value="Accept"  />
                </form>    
            <?php endif ?>
            <?php if ($canEdit) : ?>
                <form id="seatEditForm" action="<?php echo url_for('seats_accept') ?>" method="post">
                    <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                    <input id="acceptButton" type="submit" value="Edit Terms"  />
                </form>    
            <?php endif ?>
            <?php if ($canDecline) : ?>
                <form id="seatDeclineForm" action="<?php echo url_for('seats_decline') ?>" method="post">
                    <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                    <input id="declineButton" type="submit" value="Decline"  />
                </form>    
            <?php endif ?>
        </div>
    </div>
        <div id="temporaryNewSeatHolder">
        </div>
        <div id="negotiationSpinnerContainer">
            <img id="negotiationSpinner" alt="Loading..." src="/images/ajax-loader.gif" />
        </div>
        <div id="seatHistoryBlock">
            <?php include_partial('seat/negotiations', array('negotiationChanges' => $negotiationChangesHistory)) ?>
        </div>
    </div>
</div>
