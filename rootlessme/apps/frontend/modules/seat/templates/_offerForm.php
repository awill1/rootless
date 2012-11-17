<?php use_stylesheets_for_form($seatForm) ?>
<?php use_javascripts_for_form($seatForm) ?>
<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/newSeatForm.js"></script>
<?php end_slot();?>

<div id="seatDetailsBlock">
    <form id="seatRequestForm" class="userInputForm" action="<?php echo url_for('seats_offers_create') ?>" method="post">
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
                        <h2>Please select from your existing offers:</h2>
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
                        <br />
                        
                        <ul class="plainText"> Things to consider:
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
<!--        <table>
            <tbody>
                <tr>
                    <td colspan="2" >
                        If you have already offered a ride please select it:
                    </td>
                </tr>
                <?php echo $seatForm->renderHiddenFields() ?>
                <?php echo $seatForm['carpool_id']->renderRow() ?>
                <tr>
                    <td colspan="2" >
                        Fill in the details for this specific seat offer:
                    </td>
                </tr>
                <?php echo $seatForm['route']['origin']->renderRow() ?>
                <?php echo $seatForm['route']['destination']->renderRow() ?>
                <?php echo $seatForm['pickup_date']->renderRow(array('class'=>'datePicker')) ?>
                <?php echo $seatForm['pickup_time']->renderRow(array('class'=>'timePicker')) ?>
                <?php echo $seatForm['price']->renderRow() ?>
                <?php echo $seatForm['seat_count']->renderRow() ?>
                <?php echo $seatForm['description']->renderRow() ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input id="submit_seat" type="submit" value="Submit" />
                    </td>
                </tr>
            </tfoot>
        </table>-->
    </form>
</div>
<div id="temporaryNewSeatHolder">
</div>
