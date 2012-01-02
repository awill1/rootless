<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>

<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatDetailsBlock" title="Seat details">
    <div id='seatNegotiationContainer'>
    <form id="seatNegotiationForm" class="userInputForm" action="<?php echo url_for('seats_update', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
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
    </form>
    <?php if ($canAccept) : ?>
        <form id="seatAcceptForm" action="<?php echo url_for('seats_accept') ?>" method="post">
            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
            <input id="acceptButton" type="submit" value="Accept"  />
        </form>    
    <?php endif ?>
    <?php if ($canDecline) : ?>
        <form id="seatDeclineForm" action="<?php echo url_for('seats_decline') ?>" method="post">
            <input id="seat_id" name="seat_id" type="hidden" value="<?php echo $seat->getSeatId() ?>"  />
            <input id="declineButton" type="submit" value="Decline"  />
        </form>    
    <?php endif ?>
    </div>
    <div id="temporaryNewSeatHolder">
    </div>
    <div id="negotiationSpinnerContainer">
        <img id="negotiationSpinner" alt="Loading..." src="/images/ajax-loader.gif" />
    </div>
    <?php include_partial('seat/negotiations', array('negotiationChanges' => $negotiationChangesHistory)) ?>
</div>
