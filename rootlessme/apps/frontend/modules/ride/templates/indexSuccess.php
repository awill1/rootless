<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <script type="text/javascript" src="/js/Class.js"></script>
    <script type="text/javascript" src="/js/Rootless.js"></script>
    <script type="text/javascript" src="/js/Utils.js"></script>
    <script type="text/javascript" src="/js/Map.js"></script>

    <script type="text/javascript">   
      $(document).ready(function(){
        
          
        $( ".datePicker" ).datepicker();  
        
        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'hello'});
       
       //the map object
        var map = Rootless.Map.getInstance({mapId : 'map'});
        map.mapInit();
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