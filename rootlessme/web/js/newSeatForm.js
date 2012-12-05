/*
 * This is the javascript for the new seat form
 */

$(document).ready(function()
{
    // Use an ajax form
    //$('#submit_seat').bind('mouseover', jsddm_open)
   /* $('.newSeatForm').ajaxForm(
    {
        // The resulting html should be sent to the test div and replace it
        target: '#seatDetailsBlock',
        //replaceTarget: true,
        beforeSubmit: function() {

            $('#seatDetailsBlock').block({ 
            message: '<img src="/images/ajax-loader.gif" alt="Submitting..." />'
        });
        },
        
        // The callback function when the form was successfully submitted
        success: function() {
            $('#seatDetailsBlock').unblock();
        }
    });

    // When the user selects an existing ride, update the fields
    $('#seats_carpool_id').change(updateFormFields);
    $('#seats_passenger_id').change(updateFormFields);*/
});

function updateFormFields()
{
    // Update the data inputs to match the selected ride details
}