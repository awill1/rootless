/*
 * This is the javascript for the new seat form
 */

$(document).ready(function()
{
    // Use an ajax form
    //$('#submit_seat').bind('mouseover', jsddm_open)
    $('#seatRequestForm').ajaxForm(
    {
        // The resulting html should be sent to the test div and replace it
        target: '#seatDetailsBlock',
        replaceTarget: true,
        // The callback function when the form was successfully submitted
        success: function() {
        }
    });

    // When the user selects an existing ride, update the fields
    $('#seats_carpool_id').change(updateFormFields);
    $('#seats_passenger_id').change(updateFormFields);
});

function updateFormFields()
{
    // Update the data inputs to match the selected ride details
}