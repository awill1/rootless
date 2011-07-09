<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for(($form->getObject()->isNew() ? 'ride_offer_create' : 'ride_offer_update').(!$form->getObject()->isNew() ? '?carpool_id='.$form->getObject()->getCarpoolId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('ride') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', '/rides/offers/delete?carpool_id='.$form->getObject()->getCarpoolId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['route']['origin']->renderRow() ?>
      <?php echo $form['route']['destination']->renderRow() ?>
      <?php echo $form['vehicle_id']->renderRow() ?>
      <?php echo $form['seats_available']->renderRow() ?>
      <?php echo $form['start_date']->renderRow() ?>
      <?php echo $form['start_time']->renderRow() ?>
      <?php echo $form['asking_price']->renderRow() ?>
      <?php echo $form['description']->renderRow() ?>
    </tbody>
  </table>
</form>
