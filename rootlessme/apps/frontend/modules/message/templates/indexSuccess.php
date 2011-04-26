<h1>Messages List</h1>

<table>
  <thead>
    <tr>
      <th>Message</th>
      <th>Conversation</th>
      <th>Author</th>
      <th>Body</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($messages as $message): ?>
    <tr>
      <td><a href="<?php echo url_for('message/show?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>"><?php echo $message->getMessageId() ?></a></td>
      <td><a href="<?php echo url_for('message/show?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>"><?php echo $message->getConversationId() ?></a></td>
      <td><?php echo $message->getAuthorId() ?></td>
      <td><?php echo $message->getBody() ?></td>
      <td><?php echo $message->getCreatedAt() ?></td>
      <td><?php echo $message->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('message/new') ?>">New</a>
