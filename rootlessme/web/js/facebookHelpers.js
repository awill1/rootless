/*
 * This is the javascript for the Facebook Helper functions.
 * This script requires the Facebook Javascript SDK scripts to already be loaded
 * in the browser.
 */

var facebook_scope = "email,user_birthday,user_location";

function initClientFacebook()
{
}
    
$(document).ready(function(){
    // Attach to the facebook click button
    $('.facebookButton').click(onClickloginfb);
});
    
//Function gets executed when the login button in the header is clicked
function onClickloginfb() {
    // Block all login forms while the facebook login works
    blockLoginContainers();
    
   //Use the FB object's login method from the Facebook Javascript SDK to authenticate the user
   //If the user has already approved your app, she is simply logged in
   //If not, the app authentication dialog box is shown
   FB.login(onFbLogin, {scope: facebook_scope}); 
   
   // Make sure the link does not cause navigation
   return false;
}
    
function onFbLogin(response)
{
    var facebookConnectUrl = sf.url_for('user_facebook_login', { });

    //If the user is succesfully authenticated, we execute some code to handle the freshly
    //logged in user, if not, we do nothing
    if (response.authResponse) {
        //Use ajax to execute an action that handles authenticated user
        $.ajax({
            url: facebookConnectUrl,
            complete: function(){
                //Reload the page after the user is authenticated to update user-specific elements
                window.location.reload();
            }
        });
    }
    else {
        // Unblock the login containers
        unblockLoginContainers();
    }
}

function onFbCancel()
{
    // Unblock the login containers
    unblockLoginContainers(); 
}

function blockLoginContainers()
{
    // Block all login forms while the facebook login works
    $('.blockableLoginContainer').block({ 
        message: '<img src="/images/ajax-loader.gif" alt="Saving..." />'
    }); 
}


function unblockLoginContainers()
{
    // Unblock all login forms while the facebook login works
    $('.blockableLoginContainer').unblock(); 
}