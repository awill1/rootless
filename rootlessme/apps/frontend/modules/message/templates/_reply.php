<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for('messages_create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php $myProfile = $sf_user->getGuardUser()->getPeople()->getProfiles(); ?>
    <div class="messageFromReply">
        <p>From:</p>
    </div>
        <div class="messageAuthorPictureReply">
            <a href="<?php echo url_for("profile_show_user", $myProfile)  ?>"></a>
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $myProfile->getPictureUrlTiny() ?>" alt="<?php echo $myProfile->getFullName() ?>" />
        </div>
        <div class="messageInformationLinkReply">
            <a class="messageAuthorLink" href="<?php echo url_for("profile_show_user", $myProfile)  ?>"><?php echo $myProfile->getFullName() ?></a>
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
      <?php echo $form ?>
    </tbody>
  </table>
</form>
