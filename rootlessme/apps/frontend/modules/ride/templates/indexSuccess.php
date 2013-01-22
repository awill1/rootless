<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_search'); ?>"></script>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>

    <script type="text/javascript">   
      $(document).ready(function(){
          
        $( ".datePicker" ).datepicker();  
        
        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'indexSuccess'});
       
       //the map object
        var map = Rootless.Map.Search.getInstance({mapId : 'map', el: {
            $originLatitude       : $("#rides_origin_latitude"),
            $originLongitude      : $("#rides_origin_longitude"),
            $destinationLatitude  : $("#rides_destination_latitude"),
            $destinationLongitude : $("#rides_destination_longitude")
        }
        });
        map.mapInit();
      });
    </script>
    

<?php end_slot();?>

<div id="map"></div>
<h1>Find rides</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 10%; position: relative; top: 75px;" />
<div id="results"></div>
