<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for('message/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?message_id='.$form->getObject()->getMessageId().'&conversation_id='.$form->getObject()->getConversationId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php $myProfile = $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst(); ?>
    <div class="messageAuthorPicture">
        <a href="<?php echo url_for("profile_show_user", $myProfile)  ?>">
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $myProfile->getPictureUrlSmall() ?>" alt="<?php echo $myProfile->getFullName() ?>" />
        </a>
    </div>
    <div class="messageAuthorInformation">
        <a href="<?php echo url_for("profile_show_user", $myProfile)  ?>"><?php echo $myProfile->getFullName() ?></a>
    </div>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('message/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'message/delete?message_id='.$form->getObject()->getMessageId().'&conversation_id='.$form->getObject()->getConversationId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
