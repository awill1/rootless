/*
 * This is the javascript for the edit profile forms
 */

$(document).ready(function()
{
    // Make the tabs
    $("#middleProfileDetails").tabs({
        select: function(event, ui) {
        }
    });
   
    // Make the edit profile forms be ajax forms
    $(".middleProfileTabContent form").submit(function(e) 
    {
        // Block the fragment-vehicles div
        $(this).closest(".middleProfileTabContent").block({ 
            message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
        }); 
    });
    $(".middleProfileTabContent form").ajaxForm(
    {
        // The callback function when the form was successfully submitted and 
        // returned
        success: function(result, status, xhr, form) {
            // Unblock the fragment-vehicles div
            form.closest(".middleProfileTabContent").unblock();
        }
    });
});