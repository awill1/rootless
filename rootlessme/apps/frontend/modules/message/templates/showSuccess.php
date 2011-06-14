<?php use_stylesheet('message.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $message->getSubject()))
?>

<h1><?php echo $message->getSubject() ?></h1>
<div class="messageThread">
    <div class="message">
        <div class="messageAuthorInformation">
            <a href="<?php echo url_for("profile_show_user", $author)  ?>"><?php echo $author->getFullName() ?></a>
            <br />
            <?php echo $message->getCreatedAt() ?>

        </div>
        <div class="messageAuthorPicture">
            <a href="<?php echo url_for("profile_show_user", $author)  ?>">
                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author->getPictureUrlSmall() ?>" />
            </a>
        </div>
        <div class="messageBody">
            <?php echo $message->getBody() ?>
        </div>
        <hr class="messageDividerBar" />
    </div>
</div>
<h2>Reply</h2>
<?php include_partial('reply', array('form' => $replyForm)) ?>
