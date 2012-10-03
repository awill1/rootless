<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for('messages_create', array('messageType'=>$messageType)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php $myProfile = $sf_user->getGuardUser()->getPeople()->getProfiles(); ?>

  <?php foreach($participants as $participant)
    {
        echo($participant->getPersonId().' '.$participant->getProfiles()->getFullName().' ');
        
    } ?>
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
