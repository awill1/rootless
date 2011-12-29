<?php use_stylesheets_for_form($reviewForm) ?>
<?php use_javascripts_for_form($reviewForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>

<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/radioFormStyle.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        radioFormStyle($('#newReviewForm'));
        // The ride date should be a date box
        $('#reviews_ride_date').datepicker();

        // Hide the new review form initially
        $('#newReviewForm').hide();

        // Show or hide the review form as needed
        $('#newReviewButton').click(function(){
            $('#newReviewForm').toggle('blind');
            $('#newReviewButton').hide();
            return false;
        });

        $('#cancelNewReviewButton').click(function(){
            $('#newReviewForm').toggle('blind');
            $('#newReviewButton').show();
            return false;
        });

        // Hide the loader icons
        $('#graphLoader').hide();

        $('#newReviewForm').submit(function() {
            // Hide the review graphs and show the loader
            $('#driverRatingSummary').hide();
            $('#graphLoader').show();
           // Hide the form
           $('#newReviewForm').toggle('blind');

        });

        // Hide the new review temporary holder
        $('temporaryNewReviewHolder').hide();

        // New review submitting button
        if ($('#newReviewForm').length)
        {
            $('#newReviewForm').ajaxForm( 
            {
                // The resulting html should be sent to the test div
                target: '#temporaryNewReviewHolder',
                // The callback function when the form was successfully submitted
                success: function() {
                    // Move the resulting html from the temporaryNewReviewHolder
                    // to the actual review list.
                    $('#driverReviewsList').prepend($('#temporaryNewReviewHolder').contents());
                    // Update the ratings graphs
                    $('#driverRatingSummary').load(
                        '<?php echo url_for('review_ratings', array('id' => $personID) ) ?>',
                        { },
                        function() {
                            // Hide the loader and show the review graphs
                            $('#graphLoader').hide();
                            $('#driverRatingSummary').show();
                            // Clear the form
                            $('#newReviewForm').clearForm();
                            // Show the add a review button
                             $('#newReviewButton').show();
                        }
                    );
                }
            });
        }
    });
    

</script>
<?php end_slot();?>


<img id="graphLoader" alt="Loading spinner" src="/images/ajax-loader.gif" />

<div id="driverReviews">

      <?php if ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getPersonId() != $profile->getPersonId())): ?>
        <a href="#" id="newReviewButton" >+ Add a review</a>
        <form id="newReviewForm" class="userInputForm" action="<?php echo url_for('review_create') ?>" method="post" <?php $reviewForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$reviewForm->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
          <table>
            <tfoot>
              <tr>
                <td colspan="2">
                  <input id="saveNewReviewButton" type="submit" value="Save" />
                  <input id="cancelNewReviewButton" type="button" value="Cancel" />
                </td>
              </tr>
            </tfoot>
            <tbody>
              <?php echo $reviewForm ?>
            </tbody>
          </table>
        </form>
      <?php endif ?>
        <div id="temporaryNewReviewHolder"></div>
        <ul id="driverReviewsList">
        <?php foreach ($reviews as $review): ?>
         <li class="driverReviewsListItem">
             <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>"></a>
                 <img class="feedbackProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $review->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall() ?>" alt="<?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>" />
             
            <h3 class="feedbackProfileHeading">
              <span class="reviewNameColor">
                <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>">
                  <?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>
                </a>
              </span>
            </h3>
            <p class="feedbackProfileComment">
                <?php echo $review->getComments() ?>
            </p>
        </li>
        <div id="profileDivider"><hr /></div>
        <?php endforeach; ?>
      </ul>
        
    <div class="middleFriendsListMore"></div>
</div>