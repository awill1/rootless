<?php use_helper('I18N') ?>

<h2>Options form</h2>
<p><?php echo $testString; ?></p>
<h2>Signin form</h2>
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <tbody>
      <?php echo $signinForm ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="<?php echo __('Log in', null, 'sf_guard') ?>" />
          
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

<h2>Register form</h2>
<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
  <table>
    <?php echo $registerForm ?>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>