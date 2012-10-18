<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - %s to %s', $route->getOriginString(), $route->getDestinationString()))
?>

<h1>Ride Offer</h1>

<?php if ($carpool->isDeleted()): ?>
    <p>This ride has been deleted.</p>
<?php else: // The ride is not deleted ?>

    <?php slot('gmapheader'); ?>
        <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
        <script type="text/javascript" src="/js/map/negotiation/RideOffer.js"></script>
    <?php end_slot();?>

    <div id="mainRideSummary">
        <div id="mainRideDate" class="dateBlockLarge">
            <div class="dateBlockMonth">
                <?php echo date("M",strtotime($carpool->getStartDate())) ?>
            </div>
            <div class="dateBlockDate">
                <?php echo date("j",strtotime($carpool->getStartDate())) ?>
            </div>
            <div class="dateBlockTime">
                <?php echo date("g:i A",strtotime($carpool->getStartTime())) ?>
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
<!--        <span class="tripDistance"></span>-->
      
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
                        <form id="rideEditForm" class="rideActionForm" action="<?php echo url_for('ride_edit', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>" method="get">
                            <input id="rideEditButton" class="rideActionButton" type="submit" value="Edit" />
                        </form>
                    </li>
                    <li class="rideActionButtonsListItem">
                        <form id="rideDeleteForm" class="rideActionForm" action="<?php echo url_for('ride_delete', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>" method="post">
                            <input id="rideDeleteButton" class="rideActionButton" type="submit" value="Delete" />
                        </form>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    
    <div id="rideProfileMap"></div>

	<?php if ($isMyPost && $pendingSeats->count() > 0): ?>
		<div class="pendingListBlock">
        	<h3 class="green">You have <?php echo $pendingSeats->count(); ?> pending <?php echo ($pendingSeats->count() == 1 ? "request" : "requests") ?>!</h3>
            	<ul class="riderList pending">
                    <?php foreach ($pendingSeats as $seat):
                          $riderProfile = $seat->getPassengers()->getPeople()->getProfiles(); ?>
                        <li class="riderListItem">
                            <?php if ($isMyPost) :?>
                                <a id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>">
                                	<img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $riderProfile->getPictureUrlSmall() ?>" alt="<?php echo $riderProfile->getFullName() ?>" />
                                	<h3 class="green"><?php echo $riderProfile->getFullName() ?></h3>
                                	<p><?php echo $seat->getOriginLocation(); ?> to <?php echo $seat->getDestinationLocation(); ?></p>
                                </a>
                            <?php endif; ?>
                             <span id="ride-passenger-<?php echo $seat->getPassengerId() ?>" class="hidden pendingLine routePolyline"><?php echo $seat->getRoutes()->getEncodedPolyline(); ?></span> 
                        </li>
                    <?php endforeach; ?>
               </ul>
        </div>
   	<?php endif; ?>

    <div id="informationContainer">
        <div id="mainRidePeople">
            <a class="profileImageLink" href="<?php echo url_for("profile_show_user", $driver)  ?>">
                <img class="driverPicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlLarge() ?>" alt="<?php echo $driver->getFullName() ?>" />
            	<h3 class="postedByStyles">Posted By: <span class="green"><?php echo $driver->getFullName() ?></span></h3>
            </a>
			
			<div class="riderListBlock">
            	<h3><?php echo $acceptedSeats->count(); ?> accepted <?php echo ($acceptedSeats->count() == 1 ? "seat" : "seats") ?></h3>
                <?php if ($acceptedSeats->count() > 0) :?>
                <ul class="riderList accepted">
                    <?php foreach ($acceptedSeats as $seat):
                        $riderProfile = $seat->getPassengers()->getPeople()->getProfiles(); ?>
                    <li class="riderListItem">
                        <?php if ($isMyPost || $seat == $mySeat) :?>
                            <a id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>">
                                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $riderProfile->getPictureUrlSmall() ?>" alt="<?php echo $riderProfile->getFullName() ?>" />
                            </a>
                        <?php else :?>
                            <a href="<?php echo url_for("profile_show_user", $riderProfile)  ?>">
                                <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $riderProfile->getPictureUrlSmall() ?>" alt="<?php echo $riderProfile->getFullName() ?>" />
                            </a>
                        <?php endif; ?>
                        <span id="ride-passenger-<?php echo $seat->getPassengerId() ?>" class="hidden routePolyline"><?php echo $seat->getRoutes()->getEncodedPolyline(); ?></span> 
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                  <ul class="riderList accepted">
                  	<li class='none'>No Accepted seats</li>
                  </ul>
                <?php endif; ?>
            </div>
            <?php if ($isMyPost): ?>
			<div class="riderListBlock">
                <h3><?php echo $declinedSeats->count(); ?> declined <?php echo ($declinedSeats->count() == 1 ? "seat" : "seats") ?></h3>
                <?php if ($declinedSeats->count() > 0) :?>
                <ul class="riderList declined">
                    <?php foreach ($declinedSeats as $seat):
                        $riderProfile = $seat->getPassengers()->getPeople()->getProfiles(); ?>
                        <li class="riderListItem">
                            <?php if ($isMyPost) :?>
                                <a  id="seat-<?php echo $seat->getSeatId(); ?>" class="dynamicDetailsLink" href="<?php echo url_for("seats_negotiation", array('seat_id'=>$seat->getSeatId()))  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $riderProfile->getPictureUrlSmall() ?>" alt="<?php echo $riderProfile->getFullName() ?>" /></a>
                            <?php else :?>
                                <a href="<?php echo url_for("profile_show_user", $riderProfile)  ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $riderProfile->getPictureUrlSmall() ?>" alt="<?php echo $riderProfile->getFullName() ?>" /></a>
                            <?php endif; ?>
                             <span id="ride-passenger-<?php echo $seat->getPassengerId() ?>" class="hidden pendingLine routePolyline"><?php echo $seat->getRoutes()->getEncodedPolyline(); ?></span> 
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                  <ul class="riderList declined">
                    <li class='none'>No Declined seats</li>
                  </ul>
                <?php endif; ?>
            </div>
            <?php endif; ?>
			
			
        </div>
        <div id="mainRideDetails">
        	<h4>Ride Details</h4>
        	<p><?php echo nl2br($carpool->getDescription()) ?></p>
        	<p><span>Start date:</span> <?php echo date("F",strtotime($carpool->getStartDate())) ?> <?php echo date("j",strtotime($carpool->getStartDate())) ?> at <?php echo date("g:i A",strtotime($carpool->getStartTime())) ?></p>
        	<p><span>Price:</span> $<?php echo $carpool->getAskingPrice() ?> per seat</p>
        	<p><span>Number of seats:</span> <?php echo $carpool->getSeatsAvailable() ?></p>
            <?php if ($myUserId == null) : ?>
        	<!-- if user is not logged in -->
        	<h5 class="green">Only members can request rides...</h5>
                <a class="cta big-btn" href="<?php echo url_for('sf_guard_signin') ?>">Log in</a>
                <a class="cta big-btn" href="<?php echo url_for('sf_guard_register') ?>">Sign up</a>
            <?php elseif (!$isMyPost) : ?>
            	<!-- offer seen by Requester -->
                <a class="cta big-btn" href="javascript:(0)">Request a Ride</a>
            <?php elseif ($isMyPost) : ?>
            	<!-- do we want to put the edit and delete buttons here? -->
        	<?php endif; ?>
   	</div>
   	 	<?php if ($mySeat != null): ?>
   	    <?php elseif ($myUserId!=null): ?>
   	    	<?php include_component('seat', 'requestForm', array('ride'=>$carpool)) ?>
                
<!--                <div id="negotiationBox">
                    <div id="dualPost">
                        <h2>Have you already requested or posted a ride for this trip?</h2>
                        <br />
                        <input id="dualPostYes" type="radio" name="dualPostYes" style="display: none;" value="Yes" />
                        <label for="dualPostYes" id="dualPostButtonYes" class="dualYesOrNo unselectedLabel">Yes</label>
                        
                        <input id="dualPostNo" type="radio" name="dualPostNo" style="display: none;" value="No" />
                        <label for="dualPostNo" id="dualPostButtonNo" class="dualYesOrNo unselectedLabel">No</label>
                        
                    </div>
                    <div id="existingRequests">
                        <h2>Please select from your existing requests:</h2>
                        <div class="existingRequest">
                            <div class="existingRequestPicture"><img src="#" width="54" height="54" alt="person"></div>
                            <div class="existingRequestName">Person's Name</div>
                            <div class="existingRequestPlaces">New York, NY to Boston, MA</div>
                            <div class="existingRequestDate">November 24th, 2012</div>
                            <div class="existingRequestArrow">&gt;</div>
                        </div>
                    </div>
                    <div id="rideDetails1">
                        <h3>Ride Details</h3>
                        <br />
                        <h2>Where would you like to be picked up?</h2>
                        <input class="rideDetailsFields required" type="text" name="pickup" placeholder="Address, City, State"/>
                        <h2>Where would you like to be dropped off?</h2>
                        <input class="rideDetailsFields required" type="text" name="dropoff" placeholder="Address, City, State"/>
                        <h2>What day would you like to leave?</h2>
                        <input class="rideDetailsFields required" type="text" name="day" placeholder="Day"/>
                        <h2>What time would you like to leave?</h2>
                        <input class="rideDetailsFields required" type="text" name="time" placeholder="Time"/>
                        <br />
                        
                        <div id="rideDetails1NextButton" class="Button">Next</div>
                        <br /><br /><br /><br />
                        step 1 of 3
                    </div>
                    <div id="rideDetails2">
                        <h3>Ride Details</h3>
                        <h2>Would you like to adjust the asking price (per seat)?</h2>
                        <input class="rideDetailsFields required" type="text" name="pickup" placeholder="C.R.E.A.M."/>
                        <h2>How many seats do you need?</h2>
                        <input class="rideDetailsFields required" type="text" name="pickup" placeholder="How deep you rollin'?"/>
                        <br />
                        <div id="rideDetails2BackButton" class="Button">Back</div><div id="rideDetails2NextButton" class="Button">Next</div>
                        <br /><br /><br /><br />
                        step 2 of 3
                    </div>
                    <div id="discuss">
                        <h2>Is there anything else you would like to discuss?</h2>
                        <br />
                        
                        <ul> Things to consider:
                            <li>Smoking or non-smoking</li>
                            <li>Is there a return trip?</li>
                            <li>Phone number exchange</li>
                            <li>Are you bringing anything?</li>
                        </ul>
                        <br />
                        <textarea class="chatBox" name="chatBox" placeholder="Say something..."></textarea> <br />
                        this actually needs to be the back div button and the form submit button not two divs... the form in general isn't here yet either
                        <div id="discussBackButton" class="Button">Back</div><div id="discussSubmitButton" class="Button">Submit</div>
                        <br /><br /><br /><br />
                        step 3 of 3 
                    </div>
                    <div id="confirmation">Yay you did it!</div>
                    Back to Ride Profile
                </div>-->
   	    <?php endif; ?>
    </div>

<?php endif; ?>
