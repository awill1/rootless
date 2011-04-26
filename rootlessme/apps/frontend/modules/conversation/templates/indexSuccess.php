<h1>Conversations</h1>

<table>
  <thead>
    <tr>
      <th>Conversation</th>
      <th>Author</th>
      <th>Subject</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($conversations as $conversation): ?>
    <tr>
      <td><a href="<?php echo url_for('conversation/show?conversation_id='.$conversation->getConversationId()) ?>"><?php echo $conversation->getConversationId() ?></a></td>
      <td><?php echo $conversation->getAuthorId() ?></td>
      <td><?php echo $conversation->getSubject() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>