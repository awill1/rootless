<h1>Places List</h1>

<table>
  <thead>
    <tr>
      <th>Place</th>
      <th>Name</th>
      <th>Website url</th>
      <th>Is public</th>
      <th>Contact email address</th>
      <th>Contact phone number</th>
      <th>Logo url</th>
      <th>Tags</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($places as $place): ?>
    <tr>
      <td><a href="<?php echo url_for('place/show?place_id='.$place->getPlaceId()) ?>"><?php echo $place->getPlaceId() ?></a></td>
      <td><?php echo $place->getName() ?></td>
      <td><?php echo $place->getWebsiteUrl() ?></td>
      <td><?php echo $place->getIsPublic() ?></td>
      <td><?php echo $place->getContactEmailAddress() ?></td>
      <td><?php echo $place->getContactPhoneNumber() ?></td>
      <td><?php echo $place->getLogoUrl() ?></td>
      <td><?php echo $place->getTags() ?></td>
      <td><?php echo $place->getCreatedAt() ?></td>
      <td><?php echo $place->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('place/new') ?>">New</a>
