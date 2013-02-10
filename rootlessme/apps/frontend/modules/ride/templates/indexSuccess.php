<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_search'); ?>"></script>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/mustache.js"></script>

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
<h1 class="findRide green">Find rides</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 50%; margin-left: -15px; top: 0; position: relative; top: 75px;" />
<div id="results"></div>
<script id="rideTableTemplate" type="template/javascript">
    <table class="rideTable">
        <thead>
            <tr>
                <th><h2 class="dateHeader orange">{{startDate}}</h2></th>
            </tr>
    	</thead>
        <tbody>
        </tbody>
    </table>
</script>

<script id="rideItemTemplate" type="template/javascript">
    <tr>
		<td class="person-td">
        	<a class="tableLink hide" href="{{rideType}}"></a>
            <img class="rideListDriverCreatorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall(); ?>" alt="<?php echo $people ?>" />
            <span class="ride-table-name">
            	<?php echo $profile->getFirstName(); ?><br />
                <?php echo $profile->getLastName(); ?><br />
            </span>
            <div class="icon <?php $rideType == 'offer'? print "driver": print "passenger" ?>"></div>

            <span id="ride-<?php if($rideType == 'offer') { echo 'carpool-';} else { echo 'passenger-';} echo $id; ?>" class="hidden routePolyline"><?php echo $route->getEncodedPolyline(); ?></span>
		</td>
        <td class="origin-td"><?php echo $route->getOriginString(); ?></td>
        <td><span class="icon destination-arrow"></span></td>
        <td class="destination-td"><?php echo $route->getDestinationString(); ?></td>
        <td>
        	<div class="seatContainer"><?php $seats = $seats != '' ? $seats : 1; echo "<h2 class='seatCount'>" . $seats . "</h2>" . "<span class='seatText'>seat"; if($seats != 1) { echo 's'; } echo $seatText. "</span>"; ?></div>
            <div class="cost green"><?php echo $seatCost; ?></div>
        </td>
    </tr>
</script>
