<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h3><?php echo $seatTitle ?></h3>
<div id="seatDetailsBlock" title="Request a ride">
    <?php //if (!$isMyPost || !$seat->isNew()) : ?>
    <?php if (!$isMyPost ) : ?>
    <form class="userInputForm" action="<?php echo url_for('seat/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?seat_id='.$form->getObject()->getSeatId() : '')) ?>" method="post">
      <table>
        <tbody>
            <tr>
                <td colspan="2" >
                    Rootless Me saves your seat request information
                    to help match you up with rides. Please choose a saved
                    seat request to automatically fill in seat details, which
                    you can override for this specific request,
                    or enter in new seat information below.
                </td>
            </tr>
          <?php echo $form->renderHiddenFields() ?>
          <?php echo $form['carpool_id']->renderRow() ?>
          <?php echo $form['passenger_id']->renderRow() ?>
          <?php echo $form['route']['origin']->renderRow() ?>
          <?php echo $form['route']['destination']->renderRow() ?>
          <?php echo $form['seat_status_id']->renderRow() ?>
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
    <?php endif; ?>
    <?php if (!$seat->isNew()): ?>
        <?php 
        // Temporary test, this will be replaced with negotiations
        include_partial('seat/negotiations', array('negotiations' => $negotiations))
        ?>
    <?php endif; ?>

</div>
