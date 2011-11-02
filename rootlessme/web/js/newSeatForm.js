/*
 * This is the javascript for the new seat form
 */

$(document).ready(function()
{
    // Use an ajax form
    //$('#submit_seat').bind('mouseover', jsddm_open)
    $('#seatRequestForm').ajaxForm(
    {
        // The resulting html should be sent to the test div
        target: '#temporaryNewSeatHolder',
        // The callback function when the form was successfully submitted
        success: function() {
            // Move the resulting html from the temporaryNewSeatHolder
            // to the actual seat list.
            //$('#driverReviewsList').prepend($('#temporaryNewReviewHolder').contents());
            //// Update the ratings graphs
            //$('#driverRatingSummary').load(
            //    '<?php echo url_for('review_ratings', array('id' => $personID) ) ?>',
            //    { },
            //    function() {
            //        // Hide the loader and show the review graphs
            //        $('#graphLoader').hide();
            //        $('#driverRatingSummary').show();
            //        // Clear the form
            //        $('#newReviewForm').clearForm();
            //        // Show the add a review button
            //         $('#newReviewButton').show();
            //    }
            //);
        }
    });

    // When the user selects an existing ride, update the fields
    $('#seats_carpool_id').change(updateFormFields);
    $('#seats_passenger_id').change(updateFormFields);
});

function updateFormFields()
{
    alert("Changed");
}