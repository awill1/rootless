<?php use_helper('I18N') ?>

<div id="loginDialogChoiceContainer">
    <h2>Log in with Rootless</h2>
    <hr />
    <div>
        <a href="#" class="facebookLink" >Register with Facebook</a>
    </div>
    <div>
        or
    </div>
    <div>
        <a href="#" class="registerLink" >Sign up with your email</a>
    </div>
    <hr />
    <div>
        Already a member? <a href="#" class="signinLink" >Sign in</a>
    </div>
</div>
<div id="loginDialogLoginContainer">
    <h2>Signin form</h2>
    <form id="loginForm" action="<?php echo url_for('sf_guard_ajax_signin') ?>" method="post">
        <?php echo $signinForm->renderHiddenFields() ?>
        <table>
            <tbody>
                <tr>
                    <th>
                        <?php echo $signinForm['username']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $signinForm['username']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $signinForm['password']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $signinForm['password']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="<?php echo __('Log in', null, 'sf_guard') ?>" />
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <hr />
    <div>
        Not a member? <a href="#" class="registerLink" >Sign up</a>
    </div>
</div>
<div id="loginDialogJoinContainer">
    <h2>Register form</h2>
    <form id ="registerForm" action="<?php echo url_for('sf_guard_ajax_register') ?>" method="post">
      <?php echo $registerForm->renderHiddenFields() ?>
        <table>
            <tbody>
                <tr>
                    <th>
                        <?php echo $registerForm['first_name']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $registerForm['first_name']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $registerForm['last_name']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $registerForm['last_name']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $registerForm['email_address']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $registerForm['email_address']->render(array('class' => 'required email')); ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $registerForm['password']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $registerForm['password']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $registerForm['password_again']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $registerForm['password_again']->render(array('class' => 'required')); ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="register" value="<?php echo __('Join Rootless!', null, 'sf_guard') ?>" />
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <hr />
    <div>
        Already a member? <a href="#" class="signinLink" >Sign in</a>
    </div>
</div>