<?php use_stylesheet(sfConfig::get('app_css_message')) ?>
<?php use_stylesheet('fcbkComplete.css') ?>


<?php slot(
  'title',
  sprintf('Rootless - %s', $conversation->getSubject()))
?>
<script type="text/javascript" src="/js/tableRowNavigation.js"></script>
<script type="text/javascript">
              
           //<!-- Begin
          
            $('#middleMessageDetails li a').live('click', function(){
           
           $('.selectedNav').removeClass('selectedNav');
           $(this).parent().addClass('selectedNav');
           var listLink = $(this).attr('href');
           
           $('#contentBox').html("<img src='/images/ajax-loader.gif' />");
           
           $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           
           
           return false;
           
       });
                //  End -->
            </script>
<?php include_partial('messageTabs') ?>
<div id='contentBox'>
<div id='messageHolder'>
<h1 class="messageTitle"><?php echo $conversation->getSubject() ?></h1>
<div class="messageThread">
    <?php foreach ($messages as $i => $message):
            $author = $message->getPeople()->getProfiles(); ?>
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
    <div>
        <a class="backtoListLink" href="<?php echo url_for('message/index') ?>">Back to list</a>
    </div>
</div>
</div>
</div>