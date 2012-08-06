<?php use_helper('I18N') ?>

<h1><?php echo __('Log in', null, 'sf_guard') ?></h1>

<div class="facebookButton">
    <div class="facebookButtonText">Log in with Facebook</div>
</div>

<h2 class="loginDivider">Or, use your email address</h2>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>