/*
 * This is the javascript for the seat negotiation partial
 */

$(document).ready(function()
{
    // Hide the spinner
    $("#negotiationSpinner").hide();

    // When the form is submitted
    $('#seatNegotiationForm').submit(function() {
        // Show the spinner
        $('#negotiationSpinner').show();
    });

    // Use an ajax form
    $('#seatNegotiationForm').ajaxForm(
    {
        // The resulting html should be sent to the test div
        target: '#temporaryNewSeatHolder',
        // The callback function when the form was successfully submitted
        success: function() {
            // Move the resulting html from the temporaryNewSeatHolder
            // to the actual seat history list.
            $('#seatNegotiationHistoryList').prepend($('#temporaryNewSeatHolder').contents());

            // Hide the spinner
            $("#negotiationSpinner").hide();
        }
    });
    
    // Handle the accept and decline buttons
    $('#acceptButton').click(function () {
       // Submit the ajax request
       
    });

    // When the origin or the destination change, clear the route id.
    $(originTextBox).change(clearRouteId);
    $(destinationTextBox).change(clearRouteId);

    // Change all of the appropriate textboxes to date and time pickers
    $( ".datePicker" ).datepicker();
    $( ".timePicker" ).timepicker({ampm: true});
});

function clearRouteId()
{
    // Clear the route id
    $('#seats_route_route_id').val('');;
}