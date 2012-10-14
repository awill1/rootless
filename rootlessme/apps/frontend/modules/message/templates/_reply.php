<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for('messages_create', array('messageType'=>$messageType)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php $myProfile = $sf_user->getGuardUser()->getPeople()->getProfiles(); ?>
    <div id="replyRecipients">
        <?php foreach($participants as $participant){
                echo("<div class='replyRecipientsPic'>");
                
                echo("<a href=".url_for('profile_show_user', array('profile_name' => $participant->getProfiles()->getProfileName())).">");
                echo("<img src='".sfConfig::get('app_profile_picture_directory').$participant->getProfiles()->getPictureUrlTiny()."' alt='".$participant->getProfiles()->getFullName()."'>");
                echo("</a>");
                
                echo("</div>");
                
                //echo(url_for('profile_show_user', array('profile_name' => $participant->getProfiles()->getProfileName())));
                
                echo("<div class='replyRecipientsName'>");
                echo("<a href=".url_for('profile_show_user', array('profile_name' => $participant->getProfiles()->getProfileName())).">");
                echo($participant->getProfiles()->getFullName());
                echo("</a>");
                echo("</div>");
              } 
        ?>
    </div>
  <table class="messageReplyBox">
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Reply" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderHiddenFields(); ?>
        <tr>
            <td>
                <?php echo $form['body']->render(); ?>
            </td>
        </tr>
    </tbody>
  </table>
</form>
