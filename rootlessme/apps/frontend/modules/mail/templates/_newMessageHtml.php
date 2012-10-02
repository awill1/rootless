<?php $subscriberProfile = $subscriber->getProfiles();
      $otherUserProfile = $otherUser->getProfiles();
?><p>Hi <?php echo $subscriberProfile->getFirstName(); ?>,</p>

<p><?php echo $otherUserProfile->getFullName(); ?> has sent you a message!</p>

<p>You can view and reply to the message at <a href="%LINK%">%LINK%</a></p>

<p>Thanks for using Rootless,</p>

<p>The Rootless Team</p>