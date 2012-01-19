<table>
  <tbody>
    <tr>
      <th>Vehicle:</th>
      <td><?php echo $vehicle->getVehicleId() ?></td>
    </tr>
    <tr>
      <th>Person:</th>
      <td><?php echo $vehicle->getPersonId() ?></td>
    </tr>
    <tr>
      <th>Seat count:</th>
      <td><?php echo $vehicle->getSeatCount() ?></td>
    </tr>
    <tr>
      <th>Gas milage:</th>
      <td><?php echo $vehicle->getGasMilage() ?></td>
    </tr>
    <tr>
      <th>Model year:</th>
      <td><?php echo $vehicle->getModelYear() ?></td>
    </tr>
    <tr>
      <th>Make:</th>
      <td><?php echo $vehicle->getMake() ?></td>
    </tr>
    <tr>
      <th>Model:</th>
      <td><?php echo $vehicle->getModel() ?></td>
    </tr>
    <tr>
      <th>Color:</th>
      <td><?php echo $vehicle->getColor() ?></td>
    </tr>
    <tr>
      <th>License plate:</th>
      <td><?php echo $vehicle->getLicensePlate() ?></td>
    </tr>
    <tr>
      <th>Baggage count:</th>
      <td><?php echo $vehicle->getBaggageCount() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $vehicle->getDescription() ?></td>
    </tr>
    <tr>
      <th>Image url large:</th>
      <td><?php echo $vehicle->getImageUrlLarge() ?></td>
    </tr>
    <tr>
      <th>Image url small:</th>
      <td><?php echo $vehicle->getImageUrlSmall() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $vehicle->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $vehicle->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('vehicle/edit?vehicle_id='.$vehicle->getVehicleId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('vehicle/index') ?>">List</a>
