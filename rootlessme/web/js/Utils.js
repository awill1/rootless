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
    signInDialogInit : function() {       
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
        
        // Make the forms ajax forms
        $('#loginForm').ajaxForm({
            dataType:  'json', 
            success: function(data)
            {
                alert("success!");
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
                    $('#placeRideConfirmationContainer').show('blind');
                }
            }
        });
        $('#registerForm').ajaxForm();
        
        // Show the choice form first
        $("#loginDialogChoiceContainer").show();
    }
    
});

Class.addSingleton(Rootless.Static.Utils);



