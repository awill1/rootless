<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="<?php echo __('Sign in', null, 'sf_guard') ?>" />
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <?php if (!isset($showForgotPassword) || $showForgotPassword): ?>
                <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
            <?php endif; ?>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
<div>
    <a id="fbLoginButton" href="<?php url_for('user_facebook_login'); ?>" >
        Login with Facebook
    </a>
</div>
<script type="text/javascript">
    
$(document).ready(function(){
    // Attach to the facebook click button
    $('#fbLoginButton').click(onClickloginfb);
});
    
//Function gets executed when the login button in the header is clicked
function onClickloginfb() {
   //Use the FB object's login method from the Facebook Javascript SDK to authenticate the user
   //If the user has already approved your app, she is simply logged in
   //If not, the app authentication dialog box is shown
   FB.login(function(response) 
   {
      //If the user is succesfully authenticated, we execute some code to handle the freshly
      //logged in user, if not, we do nothing
      if (response.authResponse) {
         //Use ajax to execute an action that handles authenticated user
         $.ajax({
            url: "<?php echo url_for('user_facebook_login'); ?>",
            complete: function(){
               //Reload the page after the user is authenticated to update user-specific elements
               window.location.reload();
            }
         });
      }
   }, {scope:'<?php echo sfConfig::get('app_facebook_scope'); ?>'});  // Ask for the needed permissions
   
   // Make sure the link does not cause navigation
   return false;
}
</script>