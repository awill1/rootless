<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for(($form->getObject()->isNew() ? 'profile_create_user' : 'profile_update_user')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('profile') ?>">Back to list</a>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
        <?php echo $form['top5']->renderRow() ?>
        <?php echo $form['wants_to_travel_to']->renderRow() ?>
        <?php echo $form['music']->renderRow() ?>
        <?php echo $form['movies']->renderRow() ?>
        <?php echo $form['books']->renderRow() ?>
        <?php echo $form['interests']->renderRow() ?>
        <?php echo $form['favorite_websites']->renderRow() ?>
        <?php echo $form->renderHiddenFields(); ?>
    </tbody>
  </table>
</form>
