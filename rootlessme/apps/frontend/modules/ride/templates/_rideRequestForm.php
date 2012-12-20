<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="rideRequestForm" class="userInputForm newRideForm" action="<?php echo url_for(($form->getObject()->isNew() ? 'ride_create' : 'ride_update'), (!$form->getObject()->isNew() ? array('ride_type' => 'request', 'ride_id' => $form->getObject()->getRideId()) : array('ride_type' => 'request'))) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" class="submitButton" value="Submit" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['route']['origin']->renderRow(array('original-title'=>'Address, City, State')) ?>
      <?php echo $form['route']['destination']->renderRow(array('original-title'=>'Address, City, State')) ?>
      <?php echo $form['passenger_count']->renderRow() ?>
      <?php echo $form['start_date']->renderRow(array('class'=>'datePicker')) ?>
      <?php echo $form['start_time']->renderRow(array('class'=>'timePicker')) ?>
      <?php echo $form['asking_price']->renderRow() ?>
      <?php echo $form['description']->renderRow() ?>
    </tbody>
  </table>
</form>
