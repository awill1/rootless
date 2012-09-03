<?php use_stylesheet(sfConfig::get('app_css_special')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Ride with other Patriots fans to Gillette Stadium in Foxborough. The most fun gameday carpool.'))
?>
<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/special.js"></script>



<div id="main">
    <div id="headline">
        Ride with other Patriots fans to the next game. 
    </div>
    <div id="formBox">
        <form id="specialForm" action="<?php echo url_for('special_event_register'); ?>" method="post">
            <div id="formButtons">
                <div class="boxHeader" >I want to </div>
                
                <input id="wantDrive" type="radio" name="userType" style="display: none;" value="drive" />
                <label for="wantDrive" id="driveButton" class="driveOrRide unselectedLabel">drive</label>
                
                <div class="orText" > or </div> 
                
                <input id="wantRide" type="radio" name="userType" style="display: none;" value="ride" />
                <label for="wantRide" id="rideButton" class="driveOrRide unselectedLabel">ride</label>
            </div>
            
            <div id="formFields">
                <div class="formError"> </div>
                <input class="formFields required" type="text" name="name" placeholder="Name"/>
                <input class="formFields required email" type="text" name="email" placeholder="Email"/>
                
                <select name="game" class="formFields required">
                    <option value="9/16_Patriots_vs._Cardinals">9/16 Patriots vs. Cardinals</option>
                    <option value="10/7_Patriots_vs._Broncos">10/7 Patriots vs. Broncos </option>
                    <option value="10/21_Patriots_vs._Jets">10/21 Patriots vs. Jets</option>
                    <option value="11/11_Patriots_vs._Bills">11/11 Patriots vs. Bills</option>
                    <option value="11/18_Patriots_vs._Colts">11/18 Patriots vs. Colts</option>
                    <option value="12/10_Patriots_vs._Texans">12/10 Patriots vs. Texans</option>
                    <option value="12/16_Patriots_vs._49ers">12/16 Patriots vs. 49ers</option>
                    <option value="12/30_Patriots_vs._Dolphins">12/30 Patriots vs. Dolphins</option>
                </select>
                <br />
                <input class="formFields required" type="text" name="location" placeholder="From: Address, City, State"/>
                <input id="seatsField" class="formFields required digits" type="text" name="seats" placeholder="How many spare seats?"/>
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
        
        <div class="boxCopy">
            
        </div>
    </div>
    <div id="socialLinks">
        <a href="http://www.twitter.com/rootlessme"><img src="/images/twitter.png" width="30" height="30"/></a>
        <a href="http://www.facebook.com/rootlessme"><img src="/images/f_logo.png" width="30" height="30"/></a>
    </div>
</div>