<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>

<script type="text/javascript" src="/js/jquery.form.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        // Hide the new review form initially
        $('#newReviewForm').hide();

        // Show or hide the review form as needed
        $('#addFriendButton').button().click(function(){
            // Submit a friend request
            return false;
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
                }
            });
        }

    });


</script>
<?php end_slot();?>


<div>
<?php if ($showAddFriend): ?>
    <input id="addFriendButton" type="button" value="Add as friend" />
<?php elseif ($showRequestResponse): ?>
    <input id="requestResponseButton" type="button" value="Respond to request" />
<?php elseif ($showPendingText): ?>
    Friend Request Pending
<?php endif ?>
</div>
