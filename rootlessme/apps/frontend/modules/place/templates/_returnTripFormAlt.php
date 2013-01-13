<form id="roundTripForm" action="<?php echo url_for('place_create_ride') ?>" method="post">
    <input id="placeIdInput" type="hidden" name="place_id" value="<?php echo $place->getPlaceId(); ?>" />
    <input id="destinationInput" type="hidden" name="destination" value="<?php echo $place->getAddressString(); ?>" />
    <input id="originDataInput" type="hidden" name="origin_data" value="" />
    <input id="destinationDataInput" type="hidden" name="destination_data" value="" />
    <input id="departureRouteDataInput" type="hidden" name="departure_route_data" value="" />
    <input id="returnRouteDataInput" type="hidden" name="return_route_data" value="" />
  <div class="placeForm">
  <div class="formSection">  
      <div id="iAmA"><span class="primaryTextStyle">I am a</span>
            <input id="rideTypeDriver" type="radio" name="ride_type" value="driver" />
            <label for="rideTypeDriver">driver</label>
            <input id="rideTypePassenger" type="radio" name="ride_type" value="passenger" />
            <label for="rideTypePassenger">passenger</label>
            <input id="rideTypeEither" type="radio" name="ride_type" value="either" checked />
            <label for="rideTypeEither">either</label>
      </div>    
      <div id="startingFrom">
            <span class="primaryTextStyle">Starting From</span>
            <input id="originTextBox" class="longField required" type="text" name="origin" placeholder="Address, City, State" />
      </div>
  </div>
  <div class="formSection"><hr class="placeFormHr"></div>
  <div class="formSection">
      <div id="departDate">
            <span class="primaryTextStyle">Depart Date</span>
                <input id="startDateTextBox" class="datePicker shortField date" type="text" name="start_date" placeholder="MM/DD/YYYY" />
                <select id="startTimeDropDown" class="dropDown" name="start_time">
                    <option value="">Anytime</option>
                    <?php for($i = 0; $i < 24 ; $i++): ?>
                        <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                        <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                    <?php endfor; ?>
                </select>
                <br />
                <input id="startDateAnydayCheckBox" type="checkbox" name="start_date_any" />
                <label for="startDateAnydayCheckBox"><span class='fourthTextStyle'>Any day</span></label>
      </div>
      <div id="returnDate">
            <span class="primaryTextStyle">Return Date</span>
                <input id="returnDateTextBox" class="datePicker shortField date" type="text" name="return_date" placeholder="MM/DD/YYYY" />
                <select id="returnTimeDropDown" class="dropDown" name="return_time">
                    <option value="">Anytime</option>
                    <?php for($i = 0; $i < 24 ; $i++): ?>
                        <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                        <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                    <?php endfor; ?>
                </select>
                <br />
                <input id="returnDateAnydayCheckBox" type="checkbox" name="return_date_any" />
                <label for="returnDateAnydayCheckBox"><span class='fourthTextStyle'>Any day</span></label>
      </div>
  </div>   
  <div class="formSection"><hr class="placeFormHr"/></div>
  <div class="formSection">
        <div id="asADriver" class="secondaryTextStyle">As a driver:</div>
        <div id="seatsAvailable">    
        <span class="primaryTextStyle">Seats Available</span>
                <select id="driverSeatsDropDown" class="tinyDropDown" name="driver_seats">
                    <?php for($i = 1; $i < 30 ; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            <span class="primaryTextStyle">Price</span>
            <span class='dollar-sign'>$</span> <input id="driverPriceTextBox" class="tinyField number" type="text" name="driver_price" /> <span class='fourthTextStyle'>per seat</span>
        </div>   
  </div>
  <div class="formSection"><hr class="placeFormHr"/></div>
  <div class="formSection">
            <div id="asAPassenger" class="secondaryTextStyle">As a passenger:</div>
            <div id="seatsNeeded">
                <span class="primaryTextStyle">Seats needed</span>
                <select id="passengerSeatsDropDown" class="tinyDropDown" name="passenger_seats">
                    <?php for($i = 1; $i < 30 ; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <span class="primaryTextStyle">Willing to pay</span>
                <span class='dollar-sign'>$</span> <input id="passengerPriceTextBox" class="tinyField number" type="text" name="passenger_price" /> <span class='fourthTextStyle'>per seat</span>
            </div>
        
            <div id="otherRideDetails">
                <span class="primaryTextStyle">Other ride details:</span><br />
                <textarea id="otherDetailsTextArea" name="other_details" placeholder="How much space do you have/need for equipment, plans at the place, etc." ></textarea>
            </div>
    
  </div>
          <input type="submit" class="postRideButton" value="Post Ride" />
  </div>
</form>
