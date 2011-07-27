<?php use_stylesheet('message.css') ?>
<?php slot(
  'title',
  sprintf('Rootless Me - Messages'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/tableRowNavigation.js"></script>
    <!-- <!-<script type="text/javascript">
       $(function() {
             $( "#middleMessageDetails" ).tabs({
                // Fuction for when the tab is selected
                select: function(event, ui) {
                    var tabID = "#ui-tabs-" + (ui.index + 1);
                    // Include a spinner in the tab panel while the page is
                    // loading
                    $(tabID).html('<img src="/images/ajax-loader.gif" alt="Loading..." />');
                },
                load: function(event, ui) {
                    PrepareTable();
                }

            });
	});
    </script>-->
<?php end_slot();?>


<h1>Welcome to your inbox, Aaron!</h1>
<div id="middleMessageDetails">
    <ul>
        <li class="selectedNav"><a href="<?php echo url_for('messages_list', array('list_type'=>'inbox')) ?>" title="Inbox">Inbox</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'sent')) ?>" title="Sent">Sent</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'trash')) ?>" title="Trash">Trash</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'compose')) ?>" title="Compose">Compose</a></li>
    </ul>
</div>

