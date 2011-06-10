<table>
    <?php foreach ($messages as $message): ?>
        <tr>
          <td><a href="<?php echo url_for('messages_show',array($message)) ?>"><?php echo $message->getMessageId() ?></a></td>
          <td><a href="<?php echo url_for('conversations_show',array($message->getConversations())) ?>"><?php echo $message->getConversationId() ?></a></td>
          <td><?php echo $message->getAuthorId() ?></td>
          <td><?php echo $message->getBody() ?></td>
          <td><?php echo $message->getCreatedAt() ?></td>
          <td><?php echo $message->getUpdatedAt() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!--
<hr />

<a href="<?php echo url_for('message/edit?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('message/index') ?>">List</a>-->
