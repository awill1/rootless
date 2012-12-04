<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<?php end_slot();?>

<div id="seatDetailsBlock">
    <form id="seatRequestForm" class="userInputForm newSeatForm" action="<?php echo url_for('seats_offers_create') ?>" method="post">
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
                    
<!--                    add a loop to display all of the current user's existing requests that could match the ride.-->
                    <div id="existingRequests">
                        <h2 class="dualPostHeader">Please select from your existing offers:</h2>
                        <?php foreach($carpools as $driver): ?>
                        <div class="existingRequest">
                            <div class="existingRequestPicture"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPeople()->getProfiles()->getPictureUrlSmall() ?>" alt="<?php echo $driver->getPeople()->getProfiles()->getFullName() ?>"></div>
                            <div class="existingRequestName"><?php echo $driver->getPeople()->getProfiles()->getFullName() ?></div>
                            <div class="existingRequestPlaces"><?php echo $driver->getRoutes()->getOriginString() ?> to <?php echo $driver->getRoutes()->getDestinationString() ?></div>
                            <div class="existingRequestDate"><?php echo date_format(new DateTime($driver->getStartDate()), 'l, F jS Y'); ?> @ <?php echo date_format(new DateTime($driver->getStartTime()), 'g:i A') ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="rideDetails1">
                        <h3>Ride Details</h3>
                        <h2>Where would you like to pick up?</h2>
                        <div><?php echo $seatForm['route']['origin']->render(array('class'=>'rideDetailsFields', 'placeholder'=>'Address, City, State')) ?></div>
                        
                        <h2>Where would you like to drop off?</h2>
                        <div><?php echo $seatForm['route']['destination']->render(array('class'=>'rideDetailsFields', 'placeholder'=>'Address, City, State')) ?></div>
                        
                        <h2>What day would you like to leave?</h2>
                        <div><?php echo $seatForm['pickup_date']->render(array('class'=>'datePicker rideDetailsFields')) ?></div>
                        
                        <h2>What time would you like to leave?</h2>
                        <div><?php echo $seatForm['pickup_time']->render(array('class'=>'timePicker rideDetailsFields', 'placeholder'=>'click to add a time')) ?></div>         
                        <br />
                        <div id="rideDetails1NextButton" class="Button">Next</div>
                        <br /><br /><br/>
                        <span class="plainText">step 1 of 3</span>
                    </div>
                    <div id="rideDetails2">
                        <h3>Ride Details</h3>
                        <h2>Would you like to adjust the  price (per seat)?</h2>
                        <div><?php echo $seatForm['price']->render(array('class'=>'rideDetailsFields')) ?></div>
                        <h2>How many extra seats do you have?</h2>
                        <div><?php echo $seatForm['seat_count']->render(array('class'=>'rideDetailsFields')) ?></div>
                        <br />
                        <div id="rideDetails2BackButton" class="Button">Back</div><div id="rideDetails2NextButton" class="Button">Next</div>
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
<!--                        this actually needs to be the back div button and the form submit button not two divs... the form in general isn't here yet either-->
                        <div id="discussBackButton" class="Button">Back</div> <div><input type="submit" value="Submit"></div>
                        <br />
                        <span class="plainText">step 3 of 3</span>
                    </div>
                    <div id="confirmation">
                        <h2>Thank you for offering a ride!</h2><br/>
                        <div class="plainText">Be sure to check your dashboard to hear back<br />
                            from the passenger, but feel free to keep searching!<br />
                            The more offers you submit, the better your<br /> 
                            chances of finding the right passenger!
                        </div><br/>
                        <div id="confirmationBackButton" class="Button">Back to Rides</div>
                    </div>
                </div>
    </form>
    <div id="temporaryNewSeatHolder">
    </div>
</div>
