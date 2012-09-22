<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="rideOfferForm" class="userInputForm newRideForm" action="<?php echo url_for(($form->getObject()->isNew() ? 'ride_create' : 'ride_update'), (!$form->getObject()->isNew() ? array('ride_type' => 'offer', 'ride_id' => $form->getObject()->getDriverId()) : array('ride_type' => 'offer'))) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', '/rides/offer/delete?carpool_id='.$form->getObject()->getCarpoolId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" class="submitButton" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['route']['origin']->renderRow() ?>
      <?php echo $form['route']['destination']->renderRow() ?>
      <?php echo $form['vehicle_id']->renderRow() ?>
      <?php echo $form['seats_available']->renderRow() ?>
      <?php echo $form['start_date']->renderRow(array('class'=>'datePicker')) ?>
      <?php echo $form['start_time']->renderRow(array('class'=>'timePicker')) ?>
      <?php echo $form['asking_price']->renderRow() ?>
      <?php echo $form['description']->renderRow() ?>
    </tbody>
  </table>
</form>
