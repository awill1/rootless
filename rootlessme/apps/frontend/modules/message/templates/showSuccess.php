<table>
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
</table>

<!--<table>
  <tbody>
    <tr>
      <th>Message:</th>
      <td><?php echo $message->getMessageId() ?></td>
    </tr>
    <tr>
      <th>Conversation:</th>
      <td><?php echo $message->getConversationId() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $message->getAuthorId() ?></td>
    </tr>
    <tr>
      <th>Body:</th>
      <td><?php echo $message->getBody() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $message->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $message->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('message/edit?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('message/index') ?>">List</a>-->
