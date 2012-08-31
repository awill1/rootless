<?php use_helper('I18N') ?>
<?php echo __('Hi %first_name%', array('%first_name%' => $user->getFirstName()), 'sf_guard') ?>,

<?php echo __('The password for %username% has been changed on rootless.me. If you did not request your password to be changed, please email us at contact@rootless.me',
        array('%username%' => $user->getUsername()), 
        'sf_guard') ?> 

<?php echo __('Thanks,') ?> 
<?php echo __('Rootless') ?> 
