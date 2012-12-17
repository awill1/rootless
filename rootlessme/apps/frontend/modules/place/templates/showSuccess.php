<table>
  <tbody>
    <tr>
      <th>Place:</th>
      <td><?php echo $place->getPlaceId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $place->getName() ?></td>
    </tr>
    <tr>
      <th>Website url:</th>
      <td><?php echo $place->getWebsiteUrl() ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $place->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Contact email address:</th>
      <td><?php echo $place->getContactEmailAddress() ?></td>
    </tr>
    <tr>
      <th>Contact phone number:</th>
      <td><?php echo $place->getContactPhoneNumber() ?></td>
    </tr>
    <tr>
      <th>Logo url:</th>
      <td><?php echo $place->getLogoUrl() ?></td>
    </tr>
    <tr>
      <th>Tags:</th>
      <td><?php echo $place->getTags() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $place->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $place->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('place/edit?place_id='.$place->getPlaceId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('place/index') ?>">List</a>
