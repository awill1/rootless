<h1>Conversations</h1>

<?php use_stylesheet('message.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Messages'))
?>

<table id="messageTable">
  <thead>
    <tr>
      <th>Conversation</th>
      <th>Author</th>
      <th>Subject</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($conversations as $i => $conversation):
        $message = $conversation->getMessages()->getLast(); ?>
    <tr class="<?php echo fmod($i, 2) ? 'messageListAltRow' : 'messageListRow' ?>">
      <td><a href="<?php echo url_for('conversation/show?conversation_id='.$conversation->getConversationId()) ?>"><?php echo $conversation->getConversationId() ?></a></td>
      <td><?php echo $conversation->getAuthorId() ?></td>
      <td><?php echo $conversation->getSubject() ?></td>
    </tr>
    <?php endforeach; ?>

  </tbody>
</table>