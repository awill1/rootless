<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id="seatDetailsBlock" title="Request a ride">
    <?php if (!$isMyPost || !$seat->isNew()) : ?>
    <form class="userInputForm" action="<?php echo url_for('seat/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?seat_id='.$form->getObject()->getSeatId() : '')) ?>" method="post">
      <table>
        <tbody>
          <?php echo $form->renderHiddenFields() ?>
          <?php echo $form['carpool_id']->renderRow() ?>
          <?php echo $form['passenger_id']->renderRow() ?>
          <?php echo $form['route']['origin']->renderRow() ?>
          <?php echo $form['route']['destination']->renderRow() ?>
          <?php echo $form['seat_status_id']->renderRow() ?>
          <?php echo $form['seat_request_type_id']->renderRow() ?>
          <?php echo $form['pickup_date']->renderRow(array('class'=>'datePicker')) ?>
          <?php echo $form['pickup_time']->renderRow(array('class'=>'timePicker')) ?>
          <?php echo $form['price']->renderRow() ?>
          <?php echo $form['seat_count']->renderRow() ?>
          <?php echo $form['description']->renderRow() ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2">
              <input id="seat_negotiate" type="button" value="Submit" />
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
    <?php endif; ?>
    <?php if (!$seat->isNew()): ?>
    <table>
      <tbody>
        <tr>
          <th>Seat:</th>
          <td><?php echo $seat->getSeatId() ?></td>
        </tr>
        <tr>
          <th>Carpool:</th>
          <td><?php echo $seat->getCarpoolId() ?></td>
        </tr>
        <tr>
          <th>Passenger:</th>
          <td><?php echo $seat->getPassengerId() ?></td>
        </tr>
        <tr>
          <th>Seat status:</th>
          <td><?php echo $seat->getSeatStatusId() ?></td>
        </tr>
        <tr>
          <th>Seat request type:</th>
          <td><?php echo $seat->getSeatRequestTypeId() ?></td>
        </tr>
        <tr>
          <th>Price:</th>
          <td><?php echo $seat->getPrice() ?></td>
        </tr>
        <tr>
          <th>Seat count:</th>
          <td><?php echo $seat->getSeatCount() ?></td>
        </tr>
        <tr>
          <th>Pickup date:</th>
          <td><?php echo $seat->getPickupDate() ?></td>
        </tr>
        <tr>
          <th>Pickup time:</th>
          <td><?php echo $seat->getPickupTime() ?></td>
        </tr>
        <tr>
          <th>Description:</th>
          <td><?php echo $seat->getDescription() ?></td>
        </tr>
        <tr>
          <th>Created at:</th>
          <td><?php echo $seat->getCreatedAt() ?></td>
        </tr>
        <tr>
          <th>Updated at:</th>
          <td><?php echo $seat->getUpdatedAt() ?></td>
        </tr>
      </tbody>
    </table>
    <?php endif; ?>

</div>
