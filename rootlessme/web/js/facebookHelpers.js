/*
 * This is the javascript for the Facebook Helper functions.
 * This script requires the Facebook Javascript SDK scripts to already be loaded
 * in the browser.
 */

function initClientFacebook()
{
    // Attach event handlers
    FB.Event.subscribe('auth.login',onFbLogin);
}
    
function onFbLogin(response)
{
    //If the user is succesfully authenticated, we execute some code to handle the freshly
    //logged in user, if not, we do nothing
    if (response.authResponse) {
        //Use ajax to execute an action that handles authenticated user
        $.ajax({
            url: "/frontend_dev.php/facebook-connect-login",
            complete: function(){
                //Reload the page after the user is authenticated to update user-specific elements
                window.location.reload();
            }
        });
    }
}