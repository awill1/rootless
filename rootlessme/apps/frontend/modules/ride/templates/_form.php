<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="userInputForm" action="<?php echo url_for(($form->getObject()->isNew() ? 'ride_offer_create' : 'ride_offer_update').(!$form->getObject()->isNew() ? '?carpool_id='.$form->getObject()->getCarpoolId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php
echo $form->renderGlobalErrors();
echo $form->renderHiddenFields();
?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('ride') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', '/rides/offers/delete?carpool_id='.$form->getObject()->getCarpoolId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php
//        foreach($form->getEmbeddedForms() as $embeddedForm)
//        {
//            foreach($embeddedForm->getFormFieldSchema() as $field)
//            {
//              if($field instanceof sfFormFieldSchema || $field->isHidden())
//              {
//                continue; // don't render embedded Forms and hidden Fields
//              }
//              echo $field->renderRow();
//            }
//        }
//        foreach($form->getFormFieldSchema() as $field)
//        {
//          if($field instanceof sfFormFieldSchema || $field->isHidden())
//          {
//            continue; // don't render embedded Forms and hidden Fields
//          }
//          echo $field->renderRow();
//        }
      ?>
      <?php
      // Print the embedded forms first
//        foreach($form->getEmbeddedForms() as $embeddedForm)
//        {
//            foreach($embeddedForm as $field)
//            {
//              if($field instanceof sfFormFieldSchema || $field->isHidden())
//              {
//                continue; // don't render embedded Forms and hidden Fields
//              }
//              echo $field->renderRow();
//            }
//        }
//        foreach($form as $field)
//        {
//          if($field instanceof sfFormFieldSchema || $field->isHidden())
//          {
//            continue; // don't render embedded Forms and hidden Fields
//          }
//          echo $field->renderRow();
//        }
        ?>

      <?php echo $form ?>
    </tbody>
  </table>
</form>
