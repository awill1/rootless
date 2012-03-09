<?php use_stylesheet('/css/fcbkComplete.css') ?>
<?php slot(
  'title',
  sprintf('Rootless Me - New Message'))
?>

<h1>New Message</h1>
<div class="composeNew">
    
<?php include_partial('form', array('form' => $form)) ?>
</div>

<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_fcbk_complete_script') ?>"></script>
<script type="text/javascript">
    // FCBK Complete javascript
    $(document).ready(function()
    {
        // Make the to textbox act like facebook
        $("#messages_to").fcbkcomplete({json_url: "<?php echo url_for('messages_possible_recipient_list', array('sf_format' => 'json')) ?>",
                                        cache: true,
                                        filter_case: false,
                                        filter_hide: true,
                                        newel: false,
                                        width: 350});
    });
</script>