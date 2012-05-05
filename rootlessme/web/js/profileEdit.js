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
   
   // Bind the forms on the tabs to their javascript actions
   bindEditProfileForms();
});

/**
 * Binds some events to the edit profile forms
 */
function bindEditProfileForms()
{
    // Make the edit profile forms be ajax forms
    $(".middleProfileTabContent form").submit(function(e) 
    {
        // Block the fragment-vehicles div
        $(this).closest(".middleProfileTabContent").block({ 
            message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
        }); 
    });
    $(".middleProfileTabContent form").not('[enctype="multipart/form-data"]').ajaxForm(
    {
        // The callback function when the form was successfully submitted and 
        // returned
        success: function(result, status, xhr, form) {
            // Unblock the fragment-vehicles div
            form.closest(".middleProfileTabContent").html(result);
            // Rebind all of the forms
            unbindEditProfileForms();
            bindEditProfileForms();
            form.closest(".middleProfileTabContent").unblock();  
        }
    });
}

/**
 * Unbinds all actions from the edit forms
 */
function unbindEditProfileForms()
{
    $(".middleProfileTabContent form").unbind();
}