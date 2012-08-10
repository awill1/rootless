<?php use_helper('I18N') ?>

<h1><?php echo __('Log in', null, 'sf_guard') ?></h1>

<div>
    <div class="facebookButton">
        <table class="facebookButtonTable" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <i class="facebookButtonLogo"> </i>
                </td>
                <td>
                    <span class="facebookButtonBorder">
                        <span class="facebookButtonText">Log in with Facebook</span>
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>

<h2 class="loginDivider">Or, use your email address</h2>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>