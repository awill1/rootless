/*
 * Rootless.StaticUtils Class
 */

Namespace('Rootless.Static.Utils');

Rootless.Static.Utils = Class.extend({
    init : function(params) {
        this._ = $.extend(true, {
            
            formAjaxOptions : { 
                target : null,
                success: null
            }
            
        }, params);
    },
    signInDialogInit : function(onAuthenticated) {       
        // Hide all of the login forms
        $("#loginDialogChoiceContainer").hide();
        $("#loginDialogLoginContainer").hide();
        $("#loginDialogJoinContainer").hide();
       
        // Click handlers for the different display form links
        $('.signinLink').click(function (){
            $("#loginDialogChoiceContainer").hide();
            $("#loginDialogLoginContainer").show();
            $("#loginDialogJoinContainer").hide();
            // Do not follow the link url by returning false
            return false;
        });
        // Click handlers for the different display form links
        $('.registerLink').click(function (){
            $("#loginDialogChoiceContainer").hide();
            $("#loginDialogLoginContainer").hide();
            $("#loginDialogJoinContainer").show();
            // Do not follow the link url by returning false
            return false;
        });
        
        // Add in form validators
        $("#loginForm").validate({
            submitHandler: function() {
                // Make the forms ajax forms
                $('#loginForm').ajaxSubmit({
                    dataType:  'json', 
                    success: function(data)
                    {
                        // Close the dialog
                        $('#loginFormDialogContainer').dialog("close");

                        // Call the onAuthenticated callback
                        onAuthenticated();

                    },
                    error : function(xhr, status, errMsg)
                    {
                        if (xhr.status == 401)
                        {
                            $('#loginFormDialogContainer').dialog("open");
                        }
                        else
                        {
                            // If the resulting object has a message, display it in an alert
                            var obj = jQuery.parseJSON(xhr.responseText);
                            alert('There was a problem loging in. ' + obj.message); 

                            // This handler function will run when the form is complete
                            $('#loader').hide();
                        }
                    }
                });
            }
        });
        
        // Validate then ajax submit the register form
        $("#registerForm").validate({
            submitHandler: function() {
                $('#registerForm').ajaxSubmit();
            }
        });
        
        // Show the choice form first
        $("#loginDialogChoiceContainer").show();
    }
    
});

Class.addSingleton(Rootless.Static.Utils);



