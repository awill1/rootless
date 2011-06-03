<h1>Seats List</h1>

<table>
  <thead>
    <tr>
      <th>Seat</th>
      <th>Carpool</th>
      <th>Passenger</th>
      <th>Seat status</th>
      <th>Seat request type</th>
      <th>Price</th>
      <th>Seat count</th>
      <th>Pickup date</th>
      <th>Pickup time</th>
      <th>Description</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($seats as $seat): ?>
    <tr>
      <td><a href="<?php echo url_for('seat/show?seat_id='.$seat->getSeatId()) ?>"><?php echo $seat->getSeatId() ?></a></td>
      <td><?php echo $seat->getCarpoolId() ?></td>
      <td><?php echo $seat->getPassengerId() ?></td>
      <td><?php echo $seat->getSeatStatusId() ?></td>
      <td><?php echo $seat->getSeatRequestTypeId() ?></td>
      <td><?php echo $seat->getPrice() ?></td>
      <td><?php echo $seat->getSeatCount() ?></td>
      <td><?php echo $seat->getPickupDate() ?></td>
      <td><?php echo $seat->getPickupTime() ?></td>
      <td><?php echo $seat->getDescription() ?></td>
      <td><?php echo $seat->getCreatedAt() ?></td>
      <td><?php echo $seat->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('seat/new') ?>">New</a>
