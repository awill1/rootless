<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>
<script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatEditBlock" title="Edit Seat Details">
    <div id='seatNegotiationContainer'>
    <div id="seatInfo">
        <div id="seatInfoPadder">
            <div id="seatUserBox">
            	<!-- $otherPersonProfile is not defined yet --> 
                <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $otherPersonProfile)  ?>">
                            <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $otherPersonProfile->getPictureUrlLarge() ?>" alt="<?php echo $otherPersonProfile->getFullName() ?>" />
                            <h3 class="postedByStyles">Posted By: <span class="green"><?php echo $otherPersonProfile->getFullName() ?></span></h3>
                </a>
                <div id="seatHistoryToggle">See Discussion History</div>
            </div>
            <div id="seatTerms">
                <h3>Ride Details <span class="green">currently being edited by you.</span></h3>
                <form id='editSeatForm' action="#" method="post">
                <p><span>Price:</span> <input class='editSeatFields' type='text' name='price' placeholder='$<?php echo $seat->getPrice() ?>'></p>
                
                <p><span>Number of seats:</span> <input class='editSeatFields' type='text' name='seats' placeholder='<?php echo $seat->getSeatCount() ?>'></p>
                
                <p><span>Pickup Location:</span> <input class='editSeatFields' type='text' name='pickupLocation' placeholder='<?php echo $seat->getRoutes()->getOriginString() ?>'></p>
                
                <p><span>Dropoff Location:</span> <input class='editSeatFields' type='text' name='dropoffLocation' placeholder='<?php echo $seat->getRoutes()->getDestinationString() ?>'></p>
                
                <p><span>Pickup Time:</span> <input class='editSeatFields' type='text' name='pickupTime' placeholder='<?php echo date("F",strtotime($seat->getPickupDate())) ?> <?php echo date("j",strtotime($seat->getPickupDate())) ?> at <?php echo date("g:i A",strtotime($seat->getPickupTime())) ?>'></p>
                
                <p><span>Note:</span> <?php echo nl2br($seat->getDescription()) ?></p>
                <div id="seatFormButtons">
<!--                        <form id="editSeatSaveForm" action="<?php echo url_for('seats_accept') ?>" method="post">-->
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="saveButton" type="submit" value="Save"  />
                            
<!--                        <form id="editSeatCancelForm" action="<?php echo url_for('seats_negotiation', array('seat_id'=>$seat->getSeatId())) ?>" method="post">-->
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="cancelButton" type="button" value="Cancel"  />
                </form>    
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
