<?php use_helper('I18N') ?>
<?php echo __('Hi %first_name%', array('%first_name%' => $user->getFirstName()), 'sf_guard') ?>,<br/><br/>

<?php echo __('This e-mail is being sent because you requested information on how to reset your password on rootless.me.', null, 'sf_guard') ?><br/><br/>

<?php echo __('You can change your password by clicking the following link which is only valid for 24 hours:', null, 'sf_guard') ?><br/><br/>

<?php echo link_to(__('Click to change password', null, 'sf_guard'), '@sf_guard_forgot_password_change?unique_key='.$forgot_password->unique_key, 'absolute=true') ?><br /><br />

<?php echo __('Thanks,') ?> <br />
<?php echo __('Rootless') ?> 