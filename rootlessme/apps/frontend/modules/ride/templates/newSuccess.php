<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - New ride '.$rideType))
?>
<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/map/Request.js"></script>
    <script type="text/javascript">   
      $(document).ready(function(){
        
          
        $( ".datePicker" ).datepicker();  
        $( ".timePicker" ).timepicker({ampm: true});
        
        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'newSuccess.php'});
       
       //the map object
        var map = Rootless.Map.Request.getInstance({
        	mapId : 'RequestMap', 
            el : {
                $originTextBox       : $("<?php echo $rideType == 'offer' ? '#carpools_route_origin' : '#passengers_route_origin'; ?>"),
        	$destinationTextBox  : $("<?php echo $rideType == 'offer' ? '#carpools_route_destination' : '#passengers_route_destination'; ?>"),
                originTextBox       : "<?php echo $rideType == 'offer' ? '#carpools_route_origin' : '#passengers_route_origin'; ?>",
        	destinationTextBox  : "<?php echo $rideType == 'offer' ? '#carpools_route_destination' : '#passengers_route_destination'; ?>",
        	originDataField      : "<?php echo $rideType == 'offer' ? '#carpools_route_origin_data' : '#passengers_route_origin_data'; ?>",
                destinationDataField : "<?php echo $rideType == 'offer' ? '#carpools_route_destination_data' : '#passengers_route_destination_data'; ?>",
        	routeDataField       : "<?php echo $rideType == 'offer' ? '#carpools_route_route_data' : '#passengers_route_route_data'; ?>" }
        	
        });
       
        map.mapInit();
      });
    </script>

<?php end_slot();?>

<h1>New ride <?php echo $rideType ?></h1>
<div id="newRideFormArea" class="middleRidesFormArea">
<?php include_partial($partial, array('form' => $form)) ?>
</div>
<div id="RequestMap"></div>
