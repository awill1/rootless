<table>
  <tbody>
    <tr>
      <th>Event:</th>
      <td><?php echo $event->getEventId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $event->getName() ?></td>
    </tr>
    <tr>
      <th>Subheading:</th>
      <td><?php echo $event->getSubheading() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $event->getStartDate() ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $event->getEndDate() ?></td>
    </tr>
    <tr>
      <th>Website url:</th>
      <td><?php echo $event->getWebsiteUrl() ?></td>
    </tr>
    <tr>
      <th>Is partner:</th>
      <td><?php echo $event->getIsPartner() ?></td>
    </tr>
    <tr>
      <th>Contact email address:</th>
      <td><?php echo $event->getContactEmailAddress() ?></td>
    </tr>
    <tr>
      <th>Contact phone number:</th>
      <td><?php echo $event->getContactPhoneNumber() ?></td>
    </tr>
    <tr>
      <th>Index image url:</th>
      <td><?php echo $event->getIndexImageUrl() ?></td>
    </tr>
    <tr>
      <th>Tags:</th>
      <td><?php echo $event->getTags() ?></td>
    </tr>
    <tr>
      <th>Css style:</th>
      <td><?php echo $event->getCssStyle() ?></td>
    </tr>
    <tr>
      <th>Is deleted:</th>
      <td><?php echo $event->getIsDeleted() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $event->getSlug() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $event->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('event/edit?event_id='.$event->getEventId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('event/index') ?>">List</a>
