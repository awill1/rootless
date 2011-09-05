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

<hr />

<a href="<?php echo url_for('seat/edit?seat_id='.$seat->getSeatId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('seat/index') ?>">List</a>
