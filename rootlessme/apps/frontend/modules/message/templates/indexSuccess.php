<?php use_stylesheet(sfConfig::get('app_css_message')) ?>
<?php use_stylesheet('fcbkComplete.css') ?>
<?php slot(
  'title',
  sprintf('Rootless - Messages'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/tableRowNavigation.js"></script>
    <script type="text/javascript">
        
       $(document).ready(function(){
           
       var listLink = $('.selectedNav a').attr('href');
           
       $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
       var loc = window.location.href;
       var split = loc.lastIndexOf('/');
       var curr = loc.substr(split+1);
       if (curr != "messages") {
           
           
       } else {
       
       $('#middleMessageDetails li a').click(function(){
           
           $('.selectedNav').removeClass('selectedNav');
           $(this).parent().addClass('selectedNav');
           var listLink = $(this).attr('href');
           
           $('#contentBox').html("<img src='/images/ajax-loader.gif' />");
           
           $('#contentBox').load(listLink, function() {
               
               PrepareTable();
           });
           
           
           
           return false;
           
       });
       
       }
       
       });
       
       
    </script>
<?php end_slot();?>

<?php include_partial('messageTabs') ?>
<div id="contentBox"></div>

