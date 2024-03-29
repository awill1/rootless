<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<?php end_slot();?>
<div id="seatDetailsBlock">
    <form id="seatRequestForm" class="userInputForm newSeatForm" action="<?php echo url_for('seats_requests_create') ?>" method="post">
        <?php echo $seatForm->renderHiddenFields(); ?>
        <div id="negotiationBox">
                    <div id="dualPost">
                        <h2>Have you already requested or posted a ride for this trip?</h2>
                        <br />
                        <input id="dualPostYes" type="radio" name="dualPostYes" style="display: none;" value="Yes" />
                        <label for="dualPostYes" id="dualPostButtonYes" class="dualYesOrNo unselectedLabel">Yes</label>
                        
                        <input id="dualPostNo" type="radio" name="dualPostNo" style="display: none;" value="No" />
                        <label for="dualPostNo" id="dualPostButtonNo" class="dualYesOrNo unselectedLabel">No</label>
                    </div>
                    <div id="existingRequests">
                        <h2 class="dualPostHeader">Please select from your existing requests:</h2>
                        <?php foreach($passengers as $passenger): ?>
                        <div class="existingRequest">
                            <div class="existingRequestPicture"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPeople()->getProfiles()->getPictureUrlSmall() ?>" alt="<?php echo $passenger->getPeople()->getProfiles()->getFullName() ?>"></div>
                            <div class="existingRequestName"><?php echo $passenger->getPeople()->getProfiles()->getFullName() ?></div>
                            <div class="existingRequestPlaces"><?php echo $passenger->getRoutes()->getOriginString() ?> to <?php echo $passenger->getRoutes()->getDestinationString() ?></div>
                            <div class="existingRequestDate"><?php echo date_format(new DateTime($passenger->getStartDate()), 'l, F jS Y'); ?> @ <?php echo date_format(new DateTime($passenger->getStartTime()), 'g:i A') ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="rideDetails1">
                        <h3>Ride Details</h3>
                        <h2>Where would you like to be picked up?</h2>
                        <div><?php echo $seatForm['route']['origin']->render(array('class'=>'rideDetailsFields required', 'placeholder'=>'Address, City, State', 'original-title'=>'Address, City, State')) ?></div>
                        
                        <h2>Where would you like to be dropped off?</h2>
                        <div><?php echo $seatForm['route']['destination']->render(array('class'=>'rideDetailsFields required', 'placeholder'=>'Address, City, State', 'original-title'=>'Address, City, State')) ?></div>
                        
                        <h2>What day would you like to leave?</h2>
                        <div><?php echo $seatForm['pickup_date']->render(array('class'=>'datePicker rideDetailsFields required date')) ?></div>
                        
                        <h2>What time would you like to leave?</h2>
                        <div><?php echo $seatForm['pickup_time']->render(array('class'=>'timePicker rideDetailsFields time', 'placeholder'=>'click to add a time')) ?></div>
                        <br />
                        <div id="rideDetails1NextButton" class="Button">Next</div>
                        <div class="wizardError"></div>
                        <br /><br /><br/>
                        <span class="plainText">step 1 of 3</span>
                    </div>
                    <div id="rideDetails2">
                        <h3>Ride Details</h3>
                        <h2>Would you like to adjust the asking price (per seat)?</h2>
                        <div><?php echo $seatForm['price']->render(array('class'=>'rideDetailsFields required number')) ?><span class="request-dollar-sign">$</span></div>
                        <h2>How many seats do you need?</h2>
                        <div><?php echo $seatForm['seat_count']->render(array('class'=>'rideDetailsFields digits')) ?></div>
                        <br />
                        <div id="rideDetails2BackButton" class="Button">Back</div><div id="rideDetails2NextButton" class="Button">Next</div>
                        <div class="wizardError"></div>
                        <br /><br /><br/>
                        <span class="plainText">step 2 of 3</span>
                    </div>
                    <div id="discuss">
                        <h2>Is there anything else you would like to discuss?</h2>
                        <br/>
                        <span class="plainText">Things to consider:</span>
                        <ul class="plainText considerList">
                            <li>Smoking or non-smoking</li>
                            <li>Is there a return trip?</li>
                            <li>Phone number exchange</li>
                            <li>Are you bringing anything?</li>
                        </ul>
                        <br />
                        <div><?php echo $seatForm['description']->render(array('class'=>'rideDetailsFields', 'placeholder'=>'Chat...')) ?></div> <br />
                        <div id="discussBackButton" class="Button">Back</div> <div><input type="submit" value="Submit" ></div>
                        <div class="wizardError"></div>
                        <br />
                        <span class="plainText">step 3 of 3</span>
                    </div>
                    <div id="confirmation">
                        <h2>Thank you for requesting a seat!</h2><br/>
                        <div class="plainText">Be sure to check your dashboard to hear back
                            from the driver, but feel free to keep searching!
                            The more requests you submit, the better your
                            chances of finding the right ride!
                        </div><br/>
<!--                        <div id="confirmationViewButton" class="Button">View my request</div>-->
                        <div id="confirmationBackButton" class="Button">View my dashboard</div>
                    </div>
                </div>
    </form>
	<div id="temporaryNewSeatHolder">
	</div>
</div>