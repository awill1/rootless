<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - %s to %s', $route->getOriginString(), $route->getDestinationString()))
?>

<h1> Ride Request</h1>

<?php if ($passenger->isDeleted()): ?>
    <p>This ride has been deleted.</p>
<?php else: // The ride is not deleted ?>

    <?php slot('gmapheader'); ?>
    	<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
        <script type="text/javascript" src="/js/Class.js"></script>
        <script type="text/javascript" src="/js/Rootless.js"></script>
        <script type="text/javascript" src="/js/Map.js"></script>
        <script type="text/javascript" src="/js/map/Negotiation.js"></script>
        <script type="text/javascript">
			$(document).ready(function(){
				 // Change all of the appropriate textboxes to date and time pickers
                $( ".datePicker" ).datepicker();
                $( ".timePicker" ).timepicker({ampm: true});
                
                //rootless namespace that should be added to our global template
        		var rootless = Rootless.getInstance({sessionId : '_showRequest.php'});
        		
        		//the map object for negotiations 
        		var map = Rootless.Map.Negotiation.getInstance({mapId : "rideProfileMap",
        			el: {
			        	$originTextBox         : $("#seats_route_origin"),
			            $destinationTextBox    : $("#seats_route_destination"),
			            $originDataField       : $("#seats_route_origin_data"),
			            $destinationDataField  : $("#seats_route_destination_data"),
			            
        			},
        			mapItem: { polyline : { encodePolyline : "<?php echo str_replace('\\','\\\\',$route->getEncodedPolyline()); ?>"}},
        		});
        		map.mapInit();
        		
			});
        </script>
    <?php end_slot();?>

    <div id="mainRideSummary">
        <div id="mainRideDate" class="dateBlockLarge">
            <div class="dateBlockMonth">
                <?php echo date("M",strtotime($passenger->getStartDate())) ?>
            </div>
            <div class="dateBlockDate">
                <?php echo date("j",strtotime($passenger->getStartDate())) ?>
            </div>
            <div class="dateBlockTime">
                <?php echo date("g:i A",strtotime($passenger->getStartTime())) ?>
            </div>
        </div>
        <h1 id="mainEventTitle">
            <span class="rideLocations">
                <?php echo $route->getOriginString() ?>
            </span>
            <span class="rideMiddleWord">
            to
            </span>
            <span class="rideLocations">
                <?php echo $route->getDestinationString() ?>
            </span>

        </h1>
        <span class="tripDistance">One Way Trip</span>
         <div class="addThisToolBar">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
            <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fcfd8880ba6587c"></script>
            <!-- AddThis Button END -->
        </div>
    
        <?php if ($isMyPost): ?>
            <div class="rideActionButtons">
                <ul class="rideActionButtonsList">
                    <li class="rideActionButtonsListItem">
                        <form id="rideDeleteForm" class="rideActionForm" action="<?php echo url_for('ride_delete', array('ride_type' => 'request', 'ride_id' => $passenger->getPassengerId())) ?>" method="post">
                            <input id="rideDeleteButton" class="rideActionButton" type="submit" value="Delete" />
                        </form>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <div id="rideProfileMap"></div>

    <div id="informationContainer">
        <div id="mainRidePeople">
            <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $rider)  ?>">
                <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $rider->getPictureUrlLarge() ?>" alt="<?php echo $rider->getFullName() ?>" />
            	<h3 class="postedByStyles">Posted By: <span class="green"><?php echo $rider->getFullName() ?></span></h3>
            </a>
            
        </div>
        <div id="mainRideDetails">
        	<h4>Ride Details</h4>
        	<p><?php echo nl2br($passenger->getDescription()) ?></p>
        	<p><span>Price:</span> $<?php echo $passenger->getAskingPrice() ?> per seat</p>
        	<p><span>Number of seats:</span> <?php echo $passenger->getPassengerCount() ?></p>
        	<?php if ($myUserId == null) : ?>
        		<h5 class="green">Only members can offer rides...</h5>
                <a class="cta big-btn" href="<?php echo url_for('sf_guard_signin') ?>">Log in</a>
                <a class="cta big-btn" href="<?php echo url_for('sf_guard_register') ?>">Sign up</a>
        	<?php endif; ?>
        </div>
    </div>
<?php endif; ?>