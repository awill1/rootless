<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Event</th>
      <th>Name</th>
      <th>Subheading</th>
      <th>Start date</th>
      <th>End date</th>
      <th>Website url</th>
      <th>Is partner</th>
      <th>Contact email address</th>
      <th>Contact phone number</th>
      <th>Index image url</th>
      <th>Tags</th>
      <th>Css style</th>
      <th>Is deleted</th>
      <th>Slug</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?event_id='.$event->getEventId()) ?>"><?php echo $event->getEventId() ?></a></td>
      <td><?php echo $event->getName() ?></td>
      <td><?php echo $event->getSubheading() ?></td>
      <td><?php echo $event->getStartDate() ?></td>
      <td><?php echo $event->getEndDate() ?></td>
      <td><?php echo $event->getWebsiteUrl() ?></td>
      <td><?php echo $event->getIsPartner() ?></td>
      <td><?php echo $event->getContactEmailAddress() ?></td>
      <td><?php echo $event->getContactPhoneNumber() ?></td>
      <td><?php echo $event->getIndexImageUrl() ?></td>
      <td><?php echo $event->getTags() ?></td>
      <td><?php echo $event->getCssStyle() ?></td>
      <td><?php echo $event->getIsDeleted() ?></td>
      <td><?php echo $event->getSlug() ?></td>
      <td><?php echo $event->getCreatedAt() ?></td>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('event/new') ?>">New</a>
