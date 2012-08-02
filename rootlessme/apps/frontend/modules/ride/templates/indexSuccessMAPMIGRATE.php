<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <script type="text/javascript" src="/js/RootlessMap.js"></script>

    <script type="text/javascript">   
      $(document).ready(function(){
          
        $( ".datePicker" ).datepicker();  
        
        var rootlessMap = new RootlessMap('map');
        
      });
    </script>
    

<?php end_slot();?>

<h1>Find a Ride</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<div id="map"></div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 10%; position: relative; top: 75px;" />
<div id="results">
</div>