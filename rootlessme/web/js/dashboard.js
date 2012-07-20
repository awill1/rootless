/*
 * This is the javascript for the dashboard
 */

$(document).ready(function()
{
    // Wire up the action buttons
    prepareActionButtons();
});

/**
 * Performs an action on a seat using ajax
 */
function prepareActionButtons() {
    // Clear existing click handlers and add new ones on the action buttons
    $(".quickBoxDeleteRideButton").unbind('click').click(performRideAction);
    $(".quickBoxAcceptButton").unbind('click').click(performSeatAction);
    $(".quickBoxDeclineButton").unbind('click').click(performSeatAction);
}

/**
 * Performs an action on a ride using ajax
 */
function performRideAction() {
    
    // Show the confirmation dialog
    var confirmed = confirm("Are you sure you want to delete this ride?");
    if (confirmed==false)
    {
        $(this).closest(".ridesListItem").unblock();
        return false;
    }
    
    // Block the seat div
    $(this).closest(".ridesListItem").block({ 
        message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
    }); 
    
    // Post the action
    var buttonHref = $(this).attr("href");
    var parameters = {};
    console.log(buttonHref);
    //var parameters = { seat_id : seatId , format : "dashboard" };
    $(this).closest(".rideCont").load(buttonHref, parameters, function(data) {
        $(this).html(data);
        // Unblock the seat div
        $(this).closest(".ridesListItem").unblock();
        // Rebind the action buttons
        prepareActionButtons();
    });
    

    // Return false to override default click behavior
    return false;
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
     console.log(buttonHref);
    var parameters = { seat_id : seatId , format : "dashboard" };
    $(this).closest(".seatsListItem").load(buttonHref, parameters, function(data) {
        $(this).html(data);
        // Unblock the seat div
        $(this).unblock();
        // Rebind the action buttons
        prepareActionButtons();
    });
    

    // Return false to override default click behavior
    return false;
}