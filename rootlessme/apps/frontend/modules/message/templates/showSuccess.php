<?php use_stylesheet('message.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $conversation->getSubject()))
?>
<h1 class="messageTitle"><?php echo $conversation->getSubject() ?></h1>
<div class="messageThread">
    <?php foreach ($messages as $i => $message):
        $author = $message->getPeople()->getProfiles()->getFirst(); ?>
    <div class="message">
        <div class="messageAuthorPicture">
            <a href="<?php echo url_for("profile_show_user", $author)  ?>">
                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author->getPictureUrlSmall() ?>" alt="<?php echo $author->getFullName() ?>" />
            </a>
        </div>
        <div class="messageBody">
        <div class="messageAuthorInformation">
            <a class="messageAuthorLink" href="<?php echo url_for("profile_show_user", $author)  ?>"><?php echo $author->getFullName() ?></a>
            <br />
            <br />
            <span class ="dateText"><?php echo date("n\/j\/Y g\:ia",strtotime($message->getCreatedAt())) ?></span>
            <br />
        </div>
            <p class="bodyGreyBackground">
                <?php echo nl2br($message->getBody()) ?>
            </p>
        </div>
    </div>
    <hr class="messageDividerBar" />
    <?php endforeach; ?>
    <div class="messageReply">
        <h2 class="replyTitle">Reply</h2>
        <?php include_partial('reply', array('form' => $replyForm)) ?>
    </div>
</div>
