<?php use_helper('I18N') ?>
<h1><?php echo __('Register', null, 'sf_guard') ?></h1>

<div class="facebookButton">
    <div class="facebookButtonText">Register wi Facebook</div>
</div>

<h2>Or, use your email address</h2>
<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>