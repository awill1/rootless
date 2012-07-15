<?php use_helper('I18N') ?>

<h1><?php echo __('Log in', null, 'sf_guard') ?></h1>

<script type="text/javascript">
    
$(document).ready(function(){
    // Attach to the facebook click button
//    $('#fbLoginButton').click(onClickloginfb);
//    FB.Event.subscribe('auth.login',onFbLogin);
//    FB.Event.subscribe('auth.authResponseChange',onFbLogin);
});
    
//Function gets executed when the login button in the header is clicked
function onClickloginfb() {
   //Use the FB object's login method from the Facebook Javascript SDK to authenticate the user
   //If the user has already approved your app, she is simply logged in
   //If not, the app authentication dialog box is shown
   FB.login(function(response) 
   {
//      //If the user is succesfully authenticated, we execute some code to handle the freshly
//      //logged in user, if not, we do nothing
//      if (response.authResponse) {
//         //Use ajax to execute an action that handles authenticated user
//         $.ajax({
//            url: "<?php echo url_for('user_facebook_login'); ?>",
//            complete: function(){
//               //Reload the page after the user is authenticated to update user-specific elements
//               window.location.reload();
//            }
//         });
//      }
   }, {scope:'<?php echo sfConfig::get('app_facebook_scope'); ?>'});  // Ask for the needed permissions
   
   // Make sure the link does not cause navigation
   return false;
}


</script>
<fb:login-button  size="xlarge" show-faces="false"  max-rows="1" scope="<?php echo sfConfig::get('app_facebook_scope'); ?>">Log in with Facebook</fb:login-button>

<h2 class="loginDivider">Or, use your email address</h2>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>