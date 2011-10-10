<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div id="seatDetailsBlock" title="Request a ride">
    <form class="userInputForm" action="<?php echo url_for('seats_update', array('seat_id'=>$seat->getSeatId())) ?>" method="post">
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
              <input id="seat_negotiate" type="button" value="Submit Request" disabled="disabled"  />
              <input id="seat_negotiate" type="button" value="Accept" disabled="disabled" />
              <input id="seat_negotiate" type="button" value="Decline" disabled="disabled" />
              <input id="seat_negotiate" type="button" value="Negotiate" />
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
    <?php 
        include_partial('seat/negotiations', array('negotiations' => $negotiations))
    ?>
</div>
