/*
 * This is the javascript for the dashboard
 */

$(document).ready(function()
{
    // Wire up the action buttons
    prepareSeatActionButtons();
});

/**
 * Performs an action on a seat using ajax
 */
function prepareSeatActionButtons() {
    // Wire up the action buttons
    $(".quickBoxAcceptButton").click(performSeatAction);
    $(".quickBoxDeclineButton").click(performSeatAction);
}


/**
 * Performs an action on a seat using ajax
 */
function performSeatAction() {
    // Block the seat div
    $(this).closest(".seatsListItem").block({ 
        message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
    }); 
    
    // Get the seat id from within the action link
    var seatId = $(this).children(".seatIdContainer").text();
    
    // Post the action
    var buttonHref = $(this).attr("href");
    var parameters = { seat_id : seatId , format : "dashboard" };
    $(this).closest(".seatsListItem").load(buttonHref, parameters, function(data) {
        $(this).html(data);
        // Unblock the seat div
        $(this).unblock();
    });
    

    // Return false to override default click behavior
    return false;
}