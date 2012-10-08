<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('profile_update_user', array('section'=> $section)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <h3>Notify me when:</h3>
  <table>
    <thead>
        <tr>
            <td>&nbsp;</td>
            <td>Email</td>
        </tr>
    </thead>
    <tbody>
        <?php echo $form->renderHiddenFields() ?>
        <?php foreach (array_keys ($form->getEmbeddedForms()) as $embeddedFormKey) : ?>
            <tr>
                <td>
                    <?php echo $form->getEmbeddedForm($embeddedFormKey)->getObject(); ?>
                </td>
                <td>
                    <?php echo $form[$embeddedFormKey]['wants_email']->render(); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
