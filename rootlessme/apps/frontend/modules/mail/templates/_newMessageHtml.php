<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has sent you a message!</p>

<blockquote>"<?php echo nl2br($message->getBody()) ?>"</blockquote>

<p>You can view and reply to the message at <a href="<?php echo url_for('messages_show', array('message_id' => $message->getMessageId()), true); ?>"><?php echo url_for('messages_show', array('message_id' => $message->getMessageId()), true); ?></a></p>

<p>Thanks for riding with Rootless,</p>

<p>The Rootless Team</p>