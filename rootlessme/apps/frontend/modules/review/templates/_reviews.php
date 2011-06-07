<?php use_stylesheets_for_form($reviewForm) ?>
<?php use_javascripts_for_form($reviewForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>

<script type="text/javascript" src="/js/jquery.form.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        // The ride date should be a date box
        $('#reviews_ride_date').datepicker();

        // Hide the new review form initially
        $('#newReviewForm').hide();

        // Show or hide the review form as needed
        $('#newReviewButton').button().click(function(){
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
                    // Update the review list
//                    $('#test').load(
//                        '<?php echo url_for('review_show', array('id' => $personID) ) ?>',
//                        data,
//                        function() {
//                            // Hide the loader and show the review graphs
//                            $('#graphLoader').hide();
//                            $('#driverRatingSummary').show();
//                            // Clear the form
//                            // Show the add a review button
//                             $('#newReviewButton').show();
//                        }
//                    );
                }
            });
        }
//        if ($('#saveNewReviewButton').length)
//        {
//            $('#saveNewReviewButton').click(function()
//            {
//                // $('#loader').show();
//                $('#newReviewForm').submit();
//                 $('#driverReviewsList').load(
//                    $(this).parents('form').attr('action'),
//                    {  },
//                    function() {
//                       // $('#loader').hide();
//                        $('#driverRatingSummary').load(
//                                                       '<?php echo url_for('review_ratings', array('id' => $personID) ) ?>',
//                                                       { },
//                                                       function() {});
//                    }
//                  );
//            });
//        }
    });
    

</script>
<?php end_slot();?>

<div id="driverRatingSummary">
    
    <?php include_partial('review/ratingGraphs', array('ratings' => $ratings)) ?>
</div>
<img id="graphLoader" alt="Loading spinner" src="/images/ajax-loader.gif" />

<div id="driverReviews">
    <div id="driverReviewsViewBox"><a class="actionLink" href="#" >View Testimonials</a></div>

      <?php if ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getPersonId() != $profile->getPersonId())): ?>
        <button id="newReviewButton" >Add a review</button>
        <form id="newReviewForm" class="userInputForm" action="<?php echo url_for(($reviewForm->getObject()->isNew() ? 'review_create' : 'review_update')) ?>" method="post" <?php $reviewForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
             <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>">
                 <img class="feedbackProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $review->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall() ?>" alt="<?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>" />
             </a>
            <h3 class="feedbackProfileHeading">
              <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>">
                <?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>
              </a>
            </h3>
            <p class="feedbackProfileComment">
                <?php echo $review->getComments() ?>
            </p>
            <div class="feedbackProfileReply"><a class="actionLink" href="#" >Reply</a></div>
        </li>
        <?php endforeach; ?>
      </ul>
    <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>
</div>