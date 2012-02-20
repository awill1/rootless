/*
 * This is the javascript for the seat negotiation partial
 */

$(document).ready(function()
{
    // Hide the spinner
    $("#negotiationSpinner").hide();

    // AJAX form submit button handlers
    $('#seatNegotiationForm, #seatAcceptForm, #seatDeclineForm').submit(function(e) {
        var curId = $(e.target).attr('id');
        
        var picLoc ='';
        if (curId == 'seatNegotiationForm') {
            picLoc = 'pending';
        } else if (curId == 'seatAcceptForm') {
            picLoc = 'accepted';
        } else {
            picLoc = 'declined';
        }
        
        
        // Show the spinner
        $('#negotiationSpinner').show();
        $('.selectedUser').slideUp(function(){
            var parentCheck = $(this).parent();
            
            if (parentCheck.children.length == 2) {
              $(parentCheck).find('.none').show();
            } else {
              $(parentCheck).find('.none').hide();
            }
            
            $(this).slideDown().removeClass('selectedUser');
            $('.' + picLoc).find('.none').hide();
            $('.' + picLoc).append($(this));
   
            
        });
    });
   

    // Use an ajax form for the action buttons
    $('#seatNegotiationForm, #seatAcceptForm, #seatDeclineForm').ajaxForm(
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