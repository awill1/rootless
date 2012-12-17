<form action="" method="post">
    <input id="placeIdInput" type="hidden" name="place_id" value="<?php echo $place->getPlaceId(); ?>" />
  <table>
    <tbody>
        <tr>
            <td>I am a</td>
            <td>
                <input id="rideTypeDriver" type="radio" name="ride_type" value="driver" />
                <label for="rideTypeDriver">driver</label>
                <input id="rideTypePassenger" type="radio" name="ride_type" value="passenger" />
                <label for="rideTypePassenger">passenger</label>
                <input id="rideTypeEither" type="radio" name="ride_type" value="either" />
                <label for="rideTypeEither">either</label>
            </td>
        </tr>
        <tr>
            <td>Starting From</td>
            <td>
                <input id="originTextBox" type="text" name="origin" placeholder="Address, City, State" />
            </td>
        </tr>
        <tr>
            <td>Depart Date</td>
            <td>
                <input id="startDateTextBox" class="datePicker" type="text" name="start_date" placeholder="MM/DD/YYYY" />
                <select id="startTimeDropDown" name="start_time">
                    <option value="">Anytime</option>
                    <?php for($i = 0; $i < 24 ; $i++): ?>
                        <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                        <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                    <?php endfor; ?>
                </select>
                <br />
                <input id="startDateAnydayCheckBox" type="checkbox" name="start_date" placeholder="MM/DD/YYYY" />
                <label for="startDateAnydayCheckBox">Any day</label>
            </td>
        </tr>
        <tr>
            <td>Return Date</td>
            <td>
                <input id="returnDateTextBox" class="datePicker" type="text" name="return_date" placeholder="MM/DD/YYYY" />
                <select id="returnTimeDropDown" name="return_time">
                    <option value="">Anytime</option>
                    <?php for($i = 0; $i < 24 ; $i++): ?>
                        <option value="<?php echo $i; ?>:00"><?php echo $i; ?>:00</option>
                        <option value="<?php echo $i; ?>:30"><?php echo $i; ?>:30</option>
                    <?php endfor; ?>
                </select>
                <br />
                <input id="returnDateAnydayCheckBox" type="checkbox" name="return_date" placeholder="MM/DD/YYYY" />
                <label for="returnDateAnydayCheckBox">Any day</label>
            </td>
        </tr>
        <tr>
            <td class="formSubHeader" colspan="2">As a driver:</td>
        </tr>
        <tr>
            <td>Seats Available</td>
            <td>
                <select id="driverSeatsDropDown" name="driver_seats">
                    <?php for($i = 1; $i < 30 ; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td>
                $ <input id="driverPriceTextBox" type="text" name="driver_price" /> per seat
            </td>
        </tr>
        <tr>
            <td class="formSubHeader" colspan="2">As a passenger:</td>
        </tr>
        <tr>
            <td>Seats needed</td>
            <td>
                <select id="passengerSeatsDropDown" name="passenger_seats">
                    <?php for($i = 1; $i < 30 ; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Willing to pay</td>
            <td>
                $ <input id="passengerPriceTextBox" type="text" name="passenger_price" /> per seat
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Other ride details:<br />
                <textarea id="otherDetailsTextArea" name="other_details" placeholder="How much space do you have/need for equipment, plans at the place, etc." >

                </textarea>
            </td>
        </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Post Ride" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
