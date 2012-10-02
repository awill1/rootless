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
        <script type="text/javascript" src="/js/seatNegotiation.js"></script>
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
        <br />
        <span class="seatsAvailable">
            <?php echo $passenger->getPassengerCount() ?>
            <?php echo ($passenger->getPassengerCount() == 1 ? "seat" : "seats") ?>
            needed
        </span>
        <br />
        <span class="tripValue">Willing to pay: $<?php echo $passenger->getAskingPrice() ?> per person</span>
        <!-- TODO: Add smoking -->
        <p id="mainRideInformation">
            <?php echo nl2br($passenger->getDescription()) ?>
        </p>
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
            <h3 class="postedByStyles">Posted By: <a class="personLink" href="<?php echo url_for("profile_show_user", $rider)  ?>"><?php echo $rider->getFullName() ?></a></h3>
            <a href="<?php echo url_for("profile_show_user", $rider)  ?>">
                <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $rider->getPictureUrlLarge() ?>" alt="<?php echo $rider->getFullName() ?>" />
            </a>
            <div class="riderListBlock">
            <h3>Accepted</h3>
                <?php if ($acceptedSeats->count() > 0) :?>
                <ul class="riderList accepted">
                    <li class='none' style="display:none;">No Accepted seats</li>
                    <?php foreach ($acceptedSeats as $seat):
                        $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                    <li class="riderListItem">
                        <?php if ($isMyPost || $seat == $mySeat) :?>
                            <a id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>">
                                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" />
                            </a>
                        <?php else :?>
                            <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>">
                                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" />
                            </a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                  <ul class="riderList accepted">
                    <li class='none'>No Accepted seats</li>
                  </ul>
                <?php endif; ?>
            </div>
            <div class="riderListBlock">
                <h3>Declined</h3>
                <?php if ($declinedSeats->count() > 0) :?>
                <ul class="riderList declined">
                    <li class='none' style="display:none;">No Declined seats</li>
                    <?php foreach ($declinedSeats as $seat):
                        $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                        <li class="riderListItem">
                            <?php if ($isMyPost) :?>
                                <a id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                            <?php else :?>
                                <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                    <ul class="riderList declined">
                    <li class='none'>No Declined seats</li>
                  </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="mainRideDetails">
        <?php if ($isMyPost) :?>
            <div class="riderListBlock">
                <h3>Pending</h3>
                <?php if ($pendingSeats->count() > 0) :?>
                <ul class="riderList pending">
                    <li class='none' style="display:none;">No Pending seats</li>
                    <?php foreach ($pendingSeats as $seat):
                          $driverProfile = $seat->getCarpools()->getPeople()->getProfiles(); ?>
                        <li class="riderListItem">
                            <?php if ($isMyPost) :?>
                                <a id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                            <?php else :?>
                                <a href="<?php echo url_for("profile_show_user", $driverProfile)  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driverProfile->getPictureUrlSmall() ?>" alt="<?php echo $driverProfile->getFullName() ?>" /></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                  <ul class="riderList pending">
                    <li class='none'>No Pending seats</li>
                  </ul>
                <?php endif; ?>
            </div>
        <?php elseif ($mySeat != null): ?>
            <div class="riderListBlock">
                <h3>My Seat Request</h3>
                <ul class="riderList">
                    <?php $myProfile = $mySeat->getCarpools()->getPeople()->getProfiles(); ?>
                    <li class="riderListItem">
                        <a id="mySeat" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$mySeat->getSeatId()))  ?>">
                            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $myProfile->getPictureUrlSmall() ?>" alt="<?php echo $myProfile->getFullName() ?>" />
                        </a>
                    </li>
                </ul>
            </div>
        <?php elseif ($myUserId!=null): ?>
            <?php include_component('seat', 'offerForm', array('ride'=>$passenger)) ?>
        <?php else: ?>
            <div>
                You must
                <a href="<?php echo url_for('sf_guard_signin') ?>">login</a>
                or <a href="<?php echo url_for('sf_guard_register') ?>">register</a>
                to request a seat.
            </div>
        <?php endif; ?>
        <div id="seatSpinnerContainer" style="display: none;">
            <img id="negotiationSpinner" alt="Loading..." src="/images/ajax-loader.gif" />
        </div>
        <img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="vertical-align: middle; display: none" />
        <div id ="seatNegotiationBlock">

        </div>
    </div>

<?php endif; ?>
