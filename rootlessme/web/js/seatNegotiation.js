/*
 * This is the javascript for the seat negotiation partial
 */

var formAjaxOptions = 
{
    // The resulting html should be sent to the test div
   // target: '#temporaryNewSeatHolder',
    // The callback function when the form was successfully submitted
  /*  success: function() {
        // Move the resulting html from the temporaryNewSeatHolder
        // to the actual seat history list.
        $('#seatNegotiationHistoryList').prepend($('#temporaryNewSeatHolder').contents());

        $('#seatDetailsBlock').unblock();

        // Hide the spinner
        $("#negotiationSpinner").hide();
    }*/
};

$(document).ready(function()
{
	
    // Hide the spinner
  //  $("#negotiationSpinner").hide();

    // AJAX form submit button handlers
    //$('#seatNegotiationForm, #seatAcceptForm, #seatDeclineForm').submit(function(e) {
   //     e.preventDefault();
        
     //   $(this).closest('#seatDetailsBlock').block({ 
      //      message: '<img src="/images/ajax-loader.gif" alt="Submitting..." />'
   //     }); 
      //  var curId = $(e.target).attr('id');

       
       /* var picLoc ='';
        if (curId == 'seatNegotiationForm') {
            picLoc = 'pending';
        } else if (curId == 'seatAcceptForm' && ($('.selectedUser').parent().hasClass('pending') || $('.selectedUser').parent().hasClass('declined'))) {
            picLoc = 'accepted';
            $(e.target).fadeOut();
            
        } else if (curId == 'seatDeclineForm' && ($('.selectedUser').parent().hasClass('pending') || $('.selectedUser').parent().hasClass('accepted'))){
            picLoc = 'declined';
            $(e.target).fadeOut();
        } else {
            picLoc = 'pending';
        }
        */
       
        // Show the spinner
       // $('#negotiationSpinner').show();
       /* $('.selectedUser').slideUp(function(){
            var parentCheck = $(this).parent();
            
            if (parentCheck.children.length == 1) {
              $(parentCheck).find('.none').show();
            } else {
              $(parentCheck).find('.none').hide();
            }
            
            $(this).slideDown();
            $('.' + picLoc).find('.none').hide();
            $('.' + picLoc).append($(this));
        });
     */
        // Set the form submit flag
        
       // isFormSubmitPending = true;

        // Disable the default submission. We will let AJAX do it
        //MaybeSubmitForm($(e.currentTarget));

  //  });
    
    // When the origin or the destination change, clear the route id.
    //$(originTextBox).change(clearRouteId);
    //$(destinationTextBox).change(clearRouteId);
    console.log('seatNegotiations');
});

function clearRouteId()
{
    // Clear the route id
    //$('#seats_route_route_id').val('');;
}

/**
 * Tries to submit the form. It will only be submitted if none of the
 * blocking flags are set.
 */
function MaybeSubmitForm(tar)
{            
    // Check to make sure nothing is blocking submitting the form
  /*  if (canSubmitForm() && isFormSubmitPending && tar.attr('id') == 'seatNegotiationForm')
    {
        $('#seatNegotiationForm').ajaxSubmit(formAjaxOptions);
    } else if (canSubmitForm() && isFormSubmitPending && (tar.attr('id') == 'seatDeclineForm' || tar.attr('id') == 'seatAcceptForm')) {
        tar.ajaxSubmit(formAjaxOptions);
    }*/

}