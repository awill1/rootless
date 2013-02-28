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
            
            // Send an event to google analytics for the signin link
            _gaq.push(['_trackEvent', 'lateAuthentication', 'loginLink']);
            
            // Do not follow the link url by returning false
            return false;
        });
        // Click handlers for the different display form links
        $('.registerLink').click(function (){
            $("#loginDialogChoiceContainer").hide();
            $("#loginDialogLoginContainer").hide();
            $("#loginDialogJoinContainer").show();
            
            // Send an event to google analytics for the register
            _gaq.push(['_trackEvent', 'lateAuthentication', 'registerLink']);
            
            // Do not follow the link url by returning false
            return false;
        });
        //popup dialogue facebook login
        $('.facebookButtonSoft').click(function(){
            //// Block all login forms while the facebook login works
            blockLoginContainers();
            
            // Send an event to google analytics for the facebook submission
            _gaq.push(['_trackEvent', 'lateAuthentication', 'facebookSubmit']);

            //Use the FB object's login method from the Facebook Javascript SDK to authenticate the user
            //If the user has already approved your app, she is simply logged in
            //If not, the app authentication dialog box is shown
            FB.login(function(response){
                var facebookConnectUrl = sf.url_for('user_facebook_login', { });
                
                //If the user is successfully authenticated, we execute some code to handle the freshly
                //logged in user, if not, we do nothing
                if (response.authResponse) {
                    // Send an event to google analytics for the facebook submission
                    _gaq.push(['_trackEvent', 'lateAuthentication', 'facebookSuccess']);
                
                    //Use ajax to execute an action that handles authenticated user
                    $.ajax({
                        url: facebookConnectUrl,
                        complete: function(){

                            //close the dialogue
                            //resubmit the form
                            //utils.js
                            //
                            // Close the dialog
                            $('#loginFormDialogContainer').dialog("close");

                            // Call the onAuthenticated callback
                            onAuthenticated();
                        }
                    });
                }
                else {
                    // Unblock the login containers
                    unblockLoginContainers();
                }
            }, {scope: facebook_scope}); 

            // Make sure the link does not cause navigation
            return false;
        });
        
        // Add in form validators
        $("#loginForm").validate({
            submitHandler: function() {
                // Send an event to google analytics for the login submission
                _gaq.push(['_trackEvent', 'lateAuthentication', 'loginSubmit']);
                
                // Make the forms ajax forms
                $('#loginForm').ajaxSubmit({
                    dataType:  'json', 
                    success: function(data)
                    {
                        // Send an event to google analytics for the login success
                        _gaq.push(['_trackEvent', 'lateAuthentication', 'loginSuccess']);
                
                        // Close the dialog
                        $('#loginFormDialogContainer').dialog("close");

                        // Call the onAuthenticated callback
                        onAuthenticated();

                    },
                    error : function(xhr, status, errMsg)
                    {
                        // Send an event to google analytics for the login failure
                        _gaq.push(['_trackEvent', 'lateAuthentication', 'loginFailure', status]);
                        
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
                // Send an event to google analytics for the register submission
                _gaq.push(['_trackEvent', 'lateAuthentication', 'registerSubmit']);
                
                $('#registerForm').ajaxSubmit({
                    dataType:  'json', 
                    success: function(data)
                    {
                        // Send an event to google analytics for the register success
                        _gaq.push(['_trackEvent', 'lateAuthentication', 'registerSuccess']);
                        
                        // Close the dialog
                        $('#loginFormDialogContainer').dialog("close");

                        // Call the onAuthenticated callback
                        onAuthenticated();

                    },
                    error : function(xhr, status, errMsg)
                    {
                        // Send an event to google analytics for the register failure
                        _gaq.push(['_trackEvent', 'lateAuthentication', 'registerFailure', status]);
                        
                        if (xhr.status == 401)
                        {
                            $('#loginFormDialogContainer').dialog("open");
                        }
                        else
                        {
                            // If the resulting object has a message, display it in an alert
                            var obj = jQuery.parseJSON(xhr.responseText);
                            alert('There was a problem registering. ' + obj.message); 

                            // This handler function will run when the form is complete
                            $('#loader').hide();
                        }
                    }
                });
            }
        });
        
        // Show the choice form first
        $("#loginDialogChoiceContainer").show();
    },
    
    userQuickView : function(userId) {
    	console.log(userId);
    }
});

Class.addSingleton(Rootless.Static.Utils);



