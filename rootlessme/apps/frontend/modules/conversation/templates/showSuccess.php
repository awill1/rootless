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
                <a href="<?php echo url_for("profile_show_user",$profile) ?>"><?php echo $profile->getFullName(); ?></a><br />
                <?php echo format_date($message->getCreatedAt(), 'M/d/y') ?>
            </div>
            <div class="messageAuthorPicture">
                
                <a href="<?php echo url_for("profile_show_user",$profile) ?>">
                    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>" alt="<?php echo $profile->getFullName(); ?>" />
                </a>
            </div>
            <div class="messageBody">
                <div >
                    <?php echo $message->getSubject() ?>
                </div>
                <div >
                    <?php echo nl2br($message->getBody()) ?>
                </div>
            </div>
            <hr class="messageDividerBar" />
        </div>
    <?php endforeach; ?>
</div>
