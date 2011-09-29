<hr />
<h3>Seat History</h3>
<?php// foreach ($negotiations as $negotiation): ?>
    <table>
        <tbody>
            <tr>
                <th>Seat:</th>
                <td><?php echo $negotiation->getSeatId() ?></td>
            </tr>
            <tr>
                <th>Carpool:</th>
                <td><?php echo $negotiation->getCarpoolId() ?></td>
            </tr>
            <tr>
                <th>Passenger:</th>
                <td><?php echo $negotiation->getPassengerId() ?></td>
            </tr>
            <tr>
                <th>Seat status:</th>
                <td><?php echo $negotiation->getSeatStatuses() ?></td>
            </tr>
            <tr>
                <th>Seat request type:</th>
                <td><?php echo $negotiation->getSeatRequestTypeId() ?></td>
            </tr>
            <tr>
              <th>Price:</th>
                <td><?php echo $negotiation->getPrice() ?></td>
            </tr>
            <tr>
                <th>Seat count:</th>
                <td><?php echo $negotiation->getSeatCount() ?></td>
            </tr>
            <tr>
                <th>Pickup date:</th>
                <td><?php echo $negotiation->getPickupDate() ?></td>
            </tr>
            <tr>
                <th>Pickup time:</th>
                <td><?php echo $negotiation->getPickupTime() ?></td>
            </tr>
            <tr>
                <th>Description:</th>
                <td><?php echo $negotiation->getDescription() ?></td>
            </tr>
            <tr>
                <th>Created at:</th>
                <td><?php echo $negotiation->getCreatedAt() ?></td>
            </tr>
            <tr>
                <th>Updated at:</th>
                <td><?php echo $negotiation->getUpdatedAt() ?></td>
            </tr>
        </tbody>
    </table>
    <hr />
<?php //endforeach; ?>

