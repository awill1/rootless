<?php use_stylesheet(sfConfig::get('app_css_nyc')) ?>
<?php slot(
  'title',
  sprintf($title))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
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
        <form id="specialForm" action="<?php echo url_for('special_event_register'); ?>" method="post">
            <input id="rides_origin_latitude" class="required" type="hidden" name="rides_origin_latitude" value="" />
            <input id="rides_origin_longitude" type="hidden" name="rides_origin_longitude" value="" />
            <input id="rides_destination_latitude" type="hidden" name="rides_destination_latitude" value="" />
            <input id="rides_destination_longitude" type="hidden" name="rides_destination_longitude" value="" />
            
            
            <div id="">
                <div class="formError"> </div>
                I want to:<br/>
                <div class="rideTypeRadio" >
                    <input id="userTypeDrive" type="radio" name="userType" value="drive" /><label for="userTypeDrive">Drive</label>
                </div>
                <div class="rideTypeRadio" >
                    <input id="userTypeRide" type="radio" name="userType" value="ride" /><label for="userTypeRide">Ride</label>
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
                            <label for="email">Email Address:<span class="required">*</span></label>        
                        </td>
                        <td class="inputCell">
                            <input id="email" class="formFields required email" type="text" name="email" placeholder="Email"/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="labelCell">
                            <label for="phone">Phone Number:</label>
                        </td>
                        <td class="inputCell">
                            <input id="phone" class="formFields required phone" type="text" name="phone" placeholder="Phone"/><br/>
                        </td>
                    </tr>
                </table>
                
                <input id="formSubmit" class="" type="submit" value="Submit" />
                
            </div>
        </form>    
        <div id="formConfirmations">
            <div class="boxCopy">
                Thanks for ridesharing with Rootless! Your potential ride matches will be emailed to you as they become available. 
                <br /><br />
                Share this with your friends!
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
            <p>
                Mayor Bloomberg has set a minimum passenger into Manhattan. Use Rootless to find a car with empty seats or to find extra passengers so you can meet the minimum passenger limit and get into Manhattan.
            </p>
        </div>
    </div>
    <div id="socialLinks">
        <a href="http://www.twitter.com/rootlessme"><img src="/images/twitter.png" width="30" height="30"/></a>
        <a href="http://www.facebook.com/rootlessme"><img src="/images/f_logo.png" width="30" height="30"/></a>
    </div>
</div>
