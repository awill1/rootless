<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?>Hi <?php echo $subscriberProfile->getFirstName(); ?>,

<?php echo $otherUserProfile->getFullName(); ?> has sent you a message!

You can view and reply to the message at <?php echo url_for('messages_show', array('message_id' => $message->getMessageId()), true); ?>

Thanks for using Rootless,

The Rootless Team