<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
<script type="text/javascript">
    $(document).ready(function()
    {
        // The ride date should be a date box
        $('#reviews_ride_date').datepicker();

        // Hide the new review form initially
        $('#newReviewForm').hide();

        // Show or hide the review form as needed
        $('#newReviewButton').click(function(){
            $('#newReviewForm').toggle();
            return false;
        });

        $('#cancelNewReviewButton').click(function(){
            $('#newReviewForm').toggle();
            return false;
        });
    });
    

</script>
<?php end_slot();?>
<a href="#" id="newReviewButton" class="linkButton">Add a review</a>

<form id="newReviewForm" class="userInputForm" action="<?php echo url_for(($form->getObject()->isNew() ? 'review_create' : 'review_update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Save" />
          <input id="cancelNewReviewButton" type="button" value="Cancel" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
