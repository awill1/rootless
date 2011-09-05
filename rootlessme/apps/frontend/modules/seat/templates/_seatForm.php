<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>


<form class="userInputForm" action="<?php echo url_for('seats_create') ?>" method="post">
  <table>
    <tbody>
      <?php echo $seatForm->renderHiddenFields() ?>
      <?php echo $seatForm['route']['origin']->renderRow() ?>
      <?php echo $seatForm['route']['destination']->renderRow() ?>
      <?php echo $seatForm['carpool_id']->renderRow() ?>
      <?php echo $seatForm['passenger_id']->renderRow() ?>
      <?php echo $seatForm['seat_status_id']->renderRow() ?>
      <?php echo $seatForm['seat_request_type_id']->renderRow() ?>
      <?php echo $seatForm['pickup_date']->renderRow(array('class'=>'datePicker')) ?>
      <?php echo $seatForm['pickup_time']->renderRow(array('class'=>'timePicker')) ?>
      <?php echo $seatForm['price']->renderRow() ?>
      <?php echo $seatForm['seat_count']->renderRow() ?>
      <?php echo $seatForm['description']->renderRow() ?>
      <?php //echo $seatForm ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input id="rides_find" type="button" value="Submit" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
