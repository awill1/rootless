<?php use_stylesheet('message.css') ?>
<?php slot(
  'title',
  sprintf('Rootless Me - Messages'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/tableRowNavigation.js"></script>
    <script type="text/javascript">
        
       $(document).ready(function(){
           
       var listLink = $('.selectedNav a').attr('href');
           
       $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           
       $('#middleMessageDetails li a').click(function(){
           
           $('.selectedNav').removeClass('selectedNav');
           $(this).parent().addClass('selectedNav');
           var listLink = $(this).attr('href');
           
           
           
           $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           
           
           return false;
           
       });
       
       
       $('.selectedRow').live('click', function(){
           
       
           var listLink = $(this).find('.tableLink').attr('href');
           
           
           $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           return false;
           
           
            });
       
       });
    </script>
<?php end_slot();?>


<h1>Welcome to your inbox, Aaron!</h1>
<div id="middleMessageDetails">
    <ul>
        <li class="selectedNav"><a href="<?php echo url_for('messages_list', array('list_type'=>'inbox')) ?>" title="Inbox">Inbox</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'sent')) ?>" title="Sent">Sent</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'trash')) ?>" title="Trash">Trash</a></li>
        <li class=""><a href="<?php echo url_for('messages_new') ?>" class="messageButton" title="new_message">+ Message</a></li>
    </ul>
</div>
<div id="contentBox"></div>

