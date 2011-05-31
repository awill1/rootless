<h1>Reviews List</h1>

<table>
  <thead>
    <tr>
      <th>Rating</th>
      <th>Reviewer</th>
      <th>Reviewee</th>
      <th>Seat</th>
      <th>Was safe</th>
      <th>Was friendly</th>
      <th>Was punctual</th>
      <th>Was courteous</th>
      <th>Comments</th>
      <th>Driver review</th>
      <th>Passenger review</th>
      <th>Ride date</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($reviews as $review): ?>
    <tr>
      <td><a href="<?php echo url_for('review/show?id='.$review->getRatingId()) ?>"><?php echo $review->getRatingId() ?></a></td>
      <td><?php echo $review->getReviewerId() ?></td>
      <td><?php echo $review->getRevieweeId() ?></td>
      <td><?php echo $review->getSeatId() ?></td>
      <td><?php echo $review->getWasSafe() ?></td>
      <td><?php echo $review->getWasFriendly() ?></td>
      <td><?php echo $review->getWasPunctual() ?></td>
      <td><?php echo $review->getWasCourteous() ?></td>
      <td><?php echo $review->getComments() ?></td>
      <td><?php echo $review->getDriverReview() ?></td>
      <td><?php echo $review->getPassengerReview() ?></td>
      <td><?php echo $review->getRideDate() ?></td>
      <td><?php echo $review->getCreatedAt() ?></td>
      <td><?php echo $review->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('review_new') ?>">New</a>
