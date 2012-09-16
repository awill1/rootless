<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('profile_update_user', array('section'=> $section)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <h3>Notify me when:</h3>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
