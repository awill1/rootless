<?php use_stylesheet('message.css') ?>
<?php use_helper('Text') ?>
<?php use_helper('Date') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $conversation->getSubject()))
?>

<h1><?php echo $conversation->getSubject() ?></h1>
<div id="messageHeaderBar" class="messageBar">
    By <?php echo $conversation->getAuthorId() ?>
</div>
<div class="messageThread">
    <?php foreach ($messages as $message):
        $profile = $message->getPeople()->getProfiles()->getFirst();
     ?>

        <div class="message">
            <div class="messageAuthorInformation">
                <a href="<?php echo url_for("profiles/".$profile->getProfileName()) ?>"><?php echo $profile->getFirstName()." ".$profile->getLastName(); ?></a><br />
                <?php echo format_date($message->getCreatedAt(), 'M/d/y') ?>
            </div>
            <div class="messageAuthorPicture">
                
                <a href="<?php echo url_for("profiles/".$profile->getProfileName()) ?>">
                    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>" alt="<?php echo $profile->getFirstName()." ".$profile->getLastName(); ?>" />
                </a>
            </div>
            <div class="messageBody">
                <div >
                    <?php echo $message->getBody() ?>
                </div>
            </div>
            <hr class="messageDividerBar" />
        </div>
    <?php endforeach; ?>
</div>

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