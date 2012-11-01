<?php //use_stylesheet(sfConfig::get('app_css_special')) ?>
<?php slot(
  'title',
  sprintf($title))
?>
<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/realtime.js"></script>

<style>
    .home {
        background-image: url("../images/<?php echo $backgroundImage; ?>");
        background-size: cover;
        background-attachment: fixed;
    }
</style>


<div id="main">
    <div id="headline">
        <h1>
            Carpool into NYC
        </h1>
    </div>
    <div id="mapBox">
        <div id="map" ></div>
    </div>
    <div id="formBox">
        <form id="specialForm" action="<?php echo url_for('special_event_register'); ?>" method="post">
            <div id="formFields">
                <div class="formError"> </div>
                I want to:<br/>
                <input id="userTypeDrive" type="radio" name="userType" value="drive" /><label for="userTypeDrive">Drive</label><br/>
                <input id="userTypeRide" type="radio" name="userType" value="ride" /><label for="userTypeRide">Ride</label><br/>
                <input id="userTypeEither" type="radio" name="userType" value="either" /><label for="userTypeEither">Either</label><br/>
                
                <label for="origin">Start Location:<span class="required">*</span></label>
                <input class="formFields required " type="text" name="origin" placeholder="Address or Landmark"/><br/>
                
                <label for="destination">End Location:<span class="required">*</span></label>
                <input class="formFields required " type="text" name="destination" placeholder="Address or Landmark"/><br/>
                
                <label for="date">Date:<span class="required">*</span></label>
                <input class="formFields required date datePicker" type="text" name="date" placeholder="Date"/><br/>
                
                <label for="time">Time:<span class="required">*</span></label>
                <input class="formFields required time timePicker" type="text" name="time" placeholder="Time"/><br/>
                
                <label for="email">Email Address:<span class="required">*</span></label>                
                <input class="formFields required email" type="text" name="email" placeholder="Email"/><br/>
                
                <label for="phone">Phone Number:</label>
                <input class="formFields required phone" type="text" name="phone" placeholder="Phone"/><br/>
                
                <label for="phone">How many seats:</label>
                <input id="seatsField" class="formFields required digits" type="text" name="seats" placeholder="1, 2, or 3"/><br/>
                
                <input id="formSubmit" class="formFields" type="submit" value="Submit" />
                
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
