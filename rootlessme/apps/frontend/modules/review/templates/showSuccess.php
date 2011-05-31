<table>
  <tbody>
    <tr>
      <th>Rating:</th>
      <td><?php echo $review->getRatingId() ?></td>
    </tr>
    <tr>
      <th>Reviewer:</th>
      <td><?php echo $review->getReviewerId() ?></td>
    </tr>
    <tr>
      <th>Reviewee:</th>
      <td><?php echo $review->getRevieweeId() ?></td>
    </tr>
    <tr>
      <th>Seat:</th>
      <td><?php echo $review->getSeatId() ?></td>
    </tr>
    <tr>
      <th>Was safe:</th>
      <td><?php echo $review->getWasSafe() ?></td>
    </tr>
    <tr>
      <th>Was friendly:</th>
      <td><?php echo $review->getWasFriendly() ?></td>
    </tr>
    <tr>
      <th>Was punctual:</th>
      <td><?php echo $review->getWasPunctual() ?></td>
    </tr>
    <tr>
      <th>Was courteous:</th>
      <td><?php echo $review->getWasCourteous() ?></td>
    </tr>
    <tr>
      <th>Comments:</th>
      <td><?php echo $review->getComments() ?></td>
    </tr>
    <tr>
      <th>Driver review:</th>
      <td><?php echo $review->getDriverReview() ?></td>
    </tr>
    <tr>
      <th>Passenger review:</th>
      <td><?php echo $review->getPassengerReview() ?></td>
    </tr>
    <tr>
      <th>Ride date:</th>
      <td><?php echo $review->getRideDate() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $review->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $review->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('review/edit?rating_id='.$review->getRatingId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('review/index') ?>">List</a>
