/*
 * This file contains the javascript required for 
 * highlighted table rows on mouse over,
 * and clicking on a row navigates you to the
 * first link contained in the row
 *
 * Written by awilliams
 * 07/09/2011
 */

// Function when the page is ready
$(document).ready(PrepareTable());

function PrepareTable()
{
    // Make the entire message row clickable
    $(".messageTable tbody tr")
        // Change the hover style
        .hover(
            function()
            {
                HighlightRow($(this));
            }
            ,function()
            {
                UnHighlightRow($(this));
            }
        )
        .find('td:not(:has(:checkbox, a))')
            .click(function () {
                
                var listLink = $(this).parent().find("a").attr("href");
           $('#contentBox').html("<img src='../images/ajax-loader.gif' />");
          
 
           
           
           $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           return false;
        });
}

function HighlightRow(tableRow)
{
    tableRow.addClass("selectedRow");
}
function UnHighlightRow(tableRow)
{
    tableRow.removeClass("selectedRow");
}

function DoNav(theUrl)
{
    document.location.href = theUrl;
}


$(document).ready(function()
{
    /* hacky nav highlighting */
    var loc = window.location.href;

    // Add the navigation item class to all navigation items
    $('#navigation li').removeClass();
    $('#navigation li').addClass('navigationItem');

    // Add class to current section...
    // Dashboard
    if(loc.indexOf('/dashboard') > -1){
           $('#navigationDashboard').removeClass('navigationItem');
           $('#navigationDashboard').addClass('navigationItemSelected');
    }
    // Rides
    else if(loc.indexOf('/rides') > -1){
           $('#navigationRides').removeClass('navigationItem');
           $('#navigationRides').addClass('navigationItemSelected');
    }
    // Travelers
    else if(loc.indexOf('/profiles') > -1){
           $('#navigationTravelers').removeClass('navigationItem');
           $('#navigationTravelers').addClass('navigationItemSelected');
    }
    // Messages
    else if(loc.indexOf('/messages') > -1){
           $('#navigationMessages').removeClass('navigationItem');
           $('#navigationMessages').addClass('navigationItemSelected');
    }


});
