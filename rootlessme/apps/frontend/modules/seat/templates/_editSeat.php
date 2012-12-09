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
            <div id="editSeatTerms">
                <h3>Ride Details <span class="green">currently being edited by you.</span></h3>
                <form id="editSeatForm" action="<?php echo url_for('seats_update', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
                <?php echo $form->renderHiddenFields(); ?>
                <p><span>Pickup Location:</span> <?php echo $form['route']['origin']->render(array('class'=>'editSeatFields', 'placeholder'=>'Address, City, State')) ?></p>
                
                <p><span>Dropoff Location:</span> <?php echo $form['route']['destination']->render(array('class'=>'editSeatFields', 'placeholder'=>'Address, City, State')) ?></p>
                
                <p><span>Price:</span> <?php echo $form['price']->render(array('class'=>'editSeatFields editSeatFieldsShort')) ?><span class='editSeat-dollar-sign'>$</span> per seat</p>
                
                <p><span>Number of seats:</span> <?php echo $form['seat_count']->render(array('class'=>'editSeatFields editSeatFieldsShort')) ?></p>
                
                <p><span>Day:</span> <?php echo $form['pickup_date']->render(array('class'=>'datePicker editSeatFields editSeatFieldsMedium')) ?></p>
                
                <p><span>Time:</span> <?php echo $form['pickup_time']->render(array('class'=>'timePicker editSeatFields editSeatFieldsMedium')) ?></p>
                
                <p><span>Note:</span> <?php echo $form['description']->render(array('class'=>'rideDetailsFields', 'placeholder'=>'Chat...')) ?></p>
                <div id="seatFormButtons">
<!--                        <form id="editSeatSaveForm" action="<?php echo url_for('seats_accept') ?>" method="post">-->
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="saveTermsButton" type="submit" value="Send"  />
                
<!--                        <form id="editSeatCancelForm" action="<?php echo url_for('seats_negotiation', array('seat_id'=>$seat->getSeatId())) ?>" method="post">-->
                            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
                            <input id="cancelTermsButton" type="button" value="Cancel"  />
                </div>
                </form>    
                

            </div>
        </div>
        
        
        
    </div>
        <div id="temporaryNewSeatHolder" class='hide'>
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
