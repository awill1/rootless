<?php use_helper('I18N') ?>
<h1><?php echo __('Register', null, 'sf_guard') ?></h1>

<div>
    <div class="facebookButton">
        <table class="facebookButtonTable" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <i class="facebookButtonLogo"> </i>
                </td>
                <td>
                    <span class="facebookButtonBorder">
                        <span class="facebookButtonText">Register with Facebook</span>
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>

<h2>Or, use your email address</h2>
<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>