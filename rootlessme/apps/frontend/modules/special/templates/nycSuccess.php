<?php use_stylesheet(sfConfig::get('app_css_nyc')) ?>
<?php slot(
  'title',
  sprintf($title))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <?php use_javascript(sfConfig::get('app_google_map_script')) ?>
    <script type="text/javascript" src="/js/Class.js"></script>
    <script type="text/javascript" src="/js/Rootless.js"></script>
    <script type="text/javascript" src="/js/Map.js"></script>
    <script type="text/javascript" src="/js/nyc.js"></script>
    <script type="text/javascript" src="/js/googleMapHelpers.js"></script>

<?php end_slot();?>

<style>
       
    body {
        background-color: #FFFFFF;
    }
</style>


<div id="main">
    <div id="headline">
        <h1>
            NYC Carpool
        </h1>
    </div>
    <div id="mapBox">
        <div id="map" style="width:300px; height:300px;"></div>
    </div>
    <div id="formBox">
        <form id="specialForm" action="<?php echo url_for('special_nyc_register'); ?>" method="post">
            <input id="rides_origin_latitude" class="required" type="hidden" name="rides_origin_latitude" value="" />
            <input id="rides_origin_longitude" type="hidden" name="rides_origin_longitude" value="" />
            <input id="rides_destination_latitude" type="hidden" name="rides_destination_latitude" value="" />
            <input id="rides_destination_longitude" type="hidden" name="rides_destination_longitude" value="" />
            <input id="rides_origin_data" class="required" type="hidden" name="rides_origin_data" value="" />
            <input id="rides_destination_data" type="hidden" name="rides_destination_data" value="" />
            <input id="rides_route_data" type="hidden" name="rides_route_data" value="" />
            
            
            <div id="">
                <div class="formError"> </div>
                I am a:<br/>
                <div class="rideTypeRadio" >
                    <input id="userTypeDrive" type="radio" name="userType" value="drive" /><label for="userTypeDrive">Driver</label>
                </div>
                <div class="rideTypeRadio" >
                    <input id="userTypeRide" type="radio" name="userType" value="ride" /><label for="userTypeRide">Passenger</label>
                </div>
                <div class="rideTypeRadio" >
                    <input id="userTypeEither" type="radio" name="userType" value="either" checked="yes" /><label for="userTypeEither">Either</label>
                </div>
                
                <br />
                <table>
                    <tr>
                        <td class="labelCell">
                            <label for="origin">Start Location:<span class="required">*</span></label>
                        </td>
                        <td class="inputCell">
                            <input id="origin" class="formFields required " type="text" name="origin" placeholder="Address or Landmark"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="labelCell">
                            <label for="destination">End Location:<span class="required">*</span></label>
                        </td>
                        <td class="inputCell">
                            <input id="destination" class="formFields required " type="text" name="destination" placeholder="Address or Landmark"/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="labelCell">
                            <label for="date">Date:<span class="required">*</span></label>
                        </td>
                        <td class="inputCell">
                            <input id="date" class="formFields required date datePicker" type="text" name="date" placeholder="Date"/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="labelCell">
                            <label for="time">Time:<span class="required">*</span></label>
                        </td>
                        <td class="inputCell">
                            <input id="time" class="formFields required time timePicker" type="text" name="time" placeholder="Time"/><br/>
                        </td>
                    </tr>
                    <tr>        
                        <td class="labelCell">
                            <label for="name">Full Name:<span class="required">*</span></label>        
                        </td>
                        <td class="inputCell">
                            <input id="name" class="formFields required" type="text" name="name" placeholder="Full Name"/><br/>
                        </td>
                    </tr>
                    <tr>        
                        <td class="labelCell">
                            <label for="email">Email Address:<span class="required">*</span></label>        
                        </td>
                        <td class="inputCell">
                            <input id="email" class="formFields required email" type="text" name="email" placeholder="Email"/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="labelCell">
                            <label for="phone">Phone:</label>
                        </td>
                        <td class="inputCell">
                            <input id="phone" class="formFields phone" type="text" name="phone" placeholder="Phone"/><br/>
                        </td>
                    </tr>
                </table>
                
                <input id="formSubmit" class="" type="submit" value="Submit" />
                
            </div>
        </form>    
        <div id="formConfirmations">
            <div class="boxCopy">
                <h1 class="successConfirmation" >Success!</h1>
                <div>
                Your carpool request has been submitted. Your potential ride matches will be emailed to you as they become available. Thanks for ridesharing with Rootless!
                </div>
                <br />
                <br />
                
                <div id="nextStepsBox">
                    <a id="backToFormButton" class="linkButton" href="#">Want to carpool some more?</a>
                </div>
                
                <br />
                <br />
                <div>Share this with your friends!</div>
                <br /><br />
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
            </div>
        </div>
        
        <div class="descriptionBox">
            <h2 class="highlighted">URGENT - NYC volunteers need transportation! #sandyvolunteer</h2>
            <p>
                Volunteers in NYC are trying to get to troubled areas, but they are 
                having a hard time getting around with public transportation suspensions, gas shortages, and traffic.
            </p>
            <p>
                Drivers, please help volunteers get around by using this page to offer the extra seats in your vehicles, especially vans and other high occupancy
                vehicles.
            </p>
            <p>
                Volunteers, please enter your transportation needs and Rootless will help match you with drivers.
            </p>
            <p>
                Tweet @rootlessme with #sandyvolunteer if you have any ideas on how Rootless can continue helping with transportation. 
            </p>
            <h2>Gas shortage in NYC area</h2>
            <p>
                Throughout the New York area, people are experiencing gas shortages.
                Lets help each other get around during these difficult times
                by sharing empty seats in cars and carpooling whenever a car is
                needed. You can use this page to find a ride or to offer the empty
                seats in your car.
            </p>
            <h2>Minimum passenger requirement for all vehicles entering Manhattan</h2>
            <p>
                Update - The minimum passenger ban has been lifted as of 11/2/2012 afternoon, but ridesharing will still help relieve traffic in the area. 
            </p>
            <p>
                As a result of the devastating aftermath of Hurricane Sandy in New York City, Mayor Bloomberg has set a minimum passenger requirement on all cars driving into Manhattan to reduce traffic congestion. Use Rootless to find a car with empty seats or to find extra passengers so you can meet the minimum passenger limit and get into Manhattan.
            </p>
            <h2>How it works</h2>
            <p>We are trying to make ridesharing and carpooling easy for people trying to get into Manhattan.</p>
            <ol>
                <li>
                    Submit your start location, end location, date, and time or your trip along with your name, email address, and optionally a phone number.
                </li>
                <li>
                    You will receive email updates when we find drivers and passengers along your route. We will send you information on how to get in contact with them.
                </li>
                <li>
                    Contact the other person by email or sms.
                </li>
                <li>
                    Unsubscribe from the alerts after you have found a ride or filled your car.
                </li>
            </ol>
            <p>* The information you input above will only be shared with other riders who are potential carpool matches.</p>
            <h2>About Rootless</h2>
            <p>
                Rootless is a ridesharing community that helps passengers and drivers get where they want to go, together. One of our co-founders lives in Brooklyn and he has seen the transporation problems in NYC as a result of Hurricane Sandy. We wanted to help the greater New York City area get around easier during this difficult time.
            </p>
            
        </div>
    </div>
    <div id="socialLinks">
        <a href="http://www.twitter.com/rootlessme"><img src="/images/twitter.png" width="30" height="30"/></a>
        <a href="http://www.facebook.com/rootlessme"><img src="/images/f_logo.png" width="30" height="30"/></a>
    </div>
</div>
