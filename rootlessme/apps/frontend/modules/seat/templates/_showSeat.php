<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>

<script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatDetailsBlock" title="Seat details">
    <div id='seatNegotiationContainer'>
    
<!--        <form id="seatNegotiationForm" class="userInputForm" action="<?php echo url_for('seats_update', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
        <p span class="negotationInstructions">You may negotiate with the driver by changing the ride details below.
The driver can approve your request or negotiate back with you.
        </p>
      <table>
        <tbody>
          <?php echo $form->renderHiddenFields() ?>
          <?php echo $form['route']['origin']->renderRow() ?>
          <?php echo $form['route']['destination']->renderRow() ?>
          <?php echo $form['pickup_date']->renderRow(array('class'=>'datePicker')) ?>
          <?php echo $form['pickup_time']->renderRow(array('class'=>'timePicker')) ?>
          <?php echo $form['price']->renderRow() ?>
          <?php echo $form['seat_count']->renderRow() ?>
          <?php echo $form['description']->renderRow() ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2">
              <input id="negotiateButton" type="submit" value="Negotiate" />
            </td>
          </tr>
        </tfoot>
      </table>
    </form>-->
    <div id="seatDetailsBlock">
        <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $otherPersonProfile)  ?>">
                    <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $otherPersonProfile->getPictureUrlLarge() ?>" alt="<?php echo $otherPersonProfile->getFullName() ?>" />
                    <h3 class="postedByStyles">Posted By: <span class="green"><?php echo $otherPersonProfile->getFullName() ?></span></h3>
        </a>
        <div id="seatTerms">
            <h2>Ride Details</h2>
            <div id="rideMetadata">
                
            </div>
        </div>
        <div id="seatHistory"></div>
        <div id="seatButtons">
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
        <?php include_partial('seat/negotiations', array('negotiationChanges' => $negotiationChangesHistory)) ?>
    </div>
</div>
