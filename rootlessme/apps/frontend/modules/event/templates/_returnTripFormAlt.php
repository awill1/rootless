<form id="roundTripForm" action="<?php echo url_for('event_create_ride') ?>" method="post">
    <input id="placeIdInput" type="hidden" name="event_id" value="<?php echo $event->getEventId(); ?>" />
    <input id="destinationInput" type="hidden" name="destination" value="<?php// echo $event->getLocation()->getAddressString(); ?>" />
    <input id="originDataInput" type="hidden" name="origin_data" value="" />
    <input id="destinationDataInput" type="hidden" name="destination_data" value="" />
    <input id="departureRouteDataInput" type="hidden" name="departure_route_data" value="" />
    <input id="returnRouteDataInput" type="hidden" name="return_route_data" value="" />
    <div class="placeForm">
        <div class="formSection">  
            <div id="iAmA">
                <div id="iAmAText"><span class="primaryTextStyle">I am a</span></div>
                <div id="iAmAButtons">
                  <input id="rideTypeDriver" class="trackableField" type="radio" name="ride_type" value="driver" />
                  <label for="rideTypeDriver">driver</label>
                  <input id="rideTypePassenger" class="trackableField" type="radio" name="ride_type" value="passenger" />
                  <label for="rideTypePassenger">passenger</label>
                  <input id="rideTypeEither" class="trackableField" type="radio" name="ride_type" value="either" checked />
                  <label for="rideTypeEither">either</label>
                </div>
            </div>    
            <div id="startingFrom">
                <div id="startingFromText"><span class="primaryTextStyle">Starting From</span></div>
                <div id="startingFromInput"><input id="originTextBox" class="longField required trackableField" type="text" name="origin" placeholder="Address, City, State" /></div>
            </div>
        </div>
        <div class="formSection"><hr class="eventFormHr"></div>
        <div class="formSection">
            <div id="departDate">
                <div id="departDateText"><span class="primaryTextStyle">Depart Date</span></div>
                <div id="departDateInput"><input id="startDateTextBox" class="datePicker shortField date trackableField" type="text" name="start_date" placeholder="MM/DD/YYYY" /></div>
                <div id="departDatePicker">
                      <select id="startTimeDropDown" class="dropDown trackableField" name="start_time">
                          <option value="">Anytime</option>
                          <?php for($i = 0; $i < 24 ; $i++): ?>
                              <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                              <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                          <?php endfor; ?>
                      </select>
                </div>
                <br/><br/>
              <div id="departDateAnyDay">
                  <input id="startDateAnydayCheckBox" class="trackableField" type="checkbox" name="start_date_any" />
                  <label for="startDateAnydayCheckBox"><span class='fourthTextStyle'>Any day</span></label>
              </div>
            </div>
            <br /><br />
            <div id="returnDate">
                <div id="returnDateText"><span class="primaryTextStyle">Return Date</span></div>
                <div id="returnDateInput"><input id="returnDateTextBox" class="datePicker shortField date trackableField" type="text" name="return_date" placeholder="MM/DD/YYYY" /></div>
                <div id="returnDatePicker">
                    <select id="returnTimeDropDown" class="dropDown trackableField" name="return_time">
                          <option value="">Anytime</option>
                          <?php for($i = 0; $i < 24 ; $i++): ?>
                              <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                              <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                          <?php endfor; ?>
                      </select>
                </div>
                <br /><br/>
                <div id="returnDateAnyDay">
                    <input id="returnDateAnydayCheckBox" class="trackableField" type="checkbox" name="return_date_any" />
                    <label for="returnDateAnydayCheckBox"><span class='fourthTextStyle'>Any day</span></label>
                </div>
            </div>
        </div>   
        <div class="formSection"><hr class="eventFormHr hrHolder"/></div>
        <div id="driverContainer" class="formSection">
            <div id="asADriver" class="secondaryTextStyle">As a driver:</div>
            <div id="seatsAvailable">    
                <span class="primaryTextStyle">Seats available</span>
            </div>
            <div id="seatsAvailablePicker">
                <select id="driverSeatsDropDown" class="tinyDropDown trackableField" name="driver_seats">
                    <?php for($i = 1; $i < 30 ; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div id="priceText"><span class="primaryTextStyle">Price</span></div>
            <div id="priceInput">
                <span class='dollar-sign'>$</span> <input id="driverPriceTextBox" class="tinyField number trackableField" type="text" name="driver_price" /> <span class='fourthTextStyle'>per seat</span>
            </div>   
            <div class="formSection"><hr class="eventFormHr hrHolder"/></div>
        </div>
        <div id="passengerContainer" class="formSection">
            <div id="asAPassenger" class="secondaryTextStyle">As a passenger:</div>
            <div id="seatsNeeded">
                <div id="seatsNeededText"><span class="primaryTextStyle">Seats needed</span></div>
                <div id="seatsNeededPicker">
                    <select id="passengerSeatsDropDown" class="tinyDropDown trackableField" name="passenger_seats">
                        <?php for($i = 1; $i < 30 ; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div id="willingToPayText"><span class="primaryTextStyle">Willing to pay</span></div>
                <div id="willingToPayInput"><span class='dollar-sign'>$</span> <input id="passengerPriceTextBox" class="tinyField number trackableField" type="text" name="passenger_price" /> <span class='fourthTextStyle'>per seat</span></div>
            </div>
            <div class="formSection"><hr class="eventFormHr hrHolder"/></div>
        </div>
        <div class="formSection">
            <div id="otherRideDetails">
                <span class="primaryTextStyle">Other ride details:</span><br />
                <textarea id="otherDetailsTextArea" class="trackableField" name="other_details" placeholder="How much space do you have/need for equipment, plans at the place, etc." ></textarea>
            </div>
        </div>
        <input type="submit" class="postRideButton" value="Post Ride" />
    </div>
</form>
