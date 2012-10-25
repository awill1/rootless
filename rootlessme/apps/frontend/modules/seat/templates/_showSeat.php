<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>
<script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatDetailsBlock" title="Seat details">
    <div id='seatNegotiationContainer'>
    <div id="seatInfo">
        <div id="seatInfoPadder">
            <div id="seatUserBox">
                <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $otherPersonProfile)  ?>">
                            <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $otherPersonProfile->getPictureUrlLarge() ?>" alt="<?php echo $otherPersonProfile->getFullName() ?>" />
                            <h3 class="postedByStyles">Posted By: <span class="green"><?php echo $otherPersonProfile->getFullName() ?></span></h3>
                </a>
                <div id="seatHistoryToggle">See Discussion History</div>
            </div>
            <div id="seatTerms">
                <h3>Ride Details <span class="green">last edited by whoever.</span></h3>
                <p><?php echo nl2br($seat->getDescription()) ?></p>
                <p><span>Price:</span> $<?php echo $seat->getPrice() ?> per seat</p>
                <p><span>Number of seats:</span> <?php echo $seat->getSeatCount() ?></p>
                <p><span>Pickup Location:</span> <?php echo $seat->getRoutes()->getOriginString() ?></p>
                <p><span>Dropoff Location:</span> <?php echo $seat->getRoutes()->getDestinationString() ?></p>
                <p><span>Pickup Time:</span> <?php echo date("F",strtotime($seat->getPickupDate())) ?> <?php echo date("j",strtotime($seat->getPickupDate())) ?> at <?php echo date("g:i A",strtotime($seat->getPickupTime())) ?></p>
                <div id="seatFormButtons">
                    <?php $canEdit = 1; ?>
                    <?php if ($canAccept) : ?>
                        <form id="seatAcceptForm" action="<?php echo url_for('seats_accept') ?>" method="post">
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="acceptButton" type="submit" value="Accept"  />
                        </form>    
                    <?php endif ?>
                    <?php if ($canEdit) : ?>
                        <form id="seatEditForm" action="<?php echo url_for('seats_negotiation', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="acceptButton" type="button" value="Edit Terms"  />
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
            <div class="removeBtn">X</div>
            
        </div>
        
        
        
    </div>
        <div id="temporaryNewSeatHolder">
        </div>
        
    </div>
    <div id="negotiationSpinnerContainer">
            <img id="negotiationSpinner" alt="Loading..." src="/images/ajax-loader.gif" />
    </div>
    <div id="seatHistoryWhitespace"></div>
    <div id="seatHistoryBlock">
            <?php include_partial('seat/negotiations', array('negotiationChanges' => $negotiationChangesHistory)) ?>
    </div>
</div>
