<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<?php end_slot();?>

<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/seatNegotiation.js"></script>
<div id="seatDetailsBlock" title="Request a ride">
    <h3>Form: <?php echo $form->getName() ?></h3>
    <form id="seatNegotiationForm" class="userInputForm" action="<?php echo url_for('seats_update', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
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
              <input id="acceptButton" type="button" value="Accept" disabled="disabled" />
              <input id="declineButton" type="button" value="Decline" disabled="disabled" />
              <input id="negotiateButton" type="submit" value="Negotiate" />
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
    <div id="temporaryNewSeatHolder">
    </div>
    <?php 
        include_partial('seat/negotiations', array('negotiations' => $negotiations))
    ?>
</div>
