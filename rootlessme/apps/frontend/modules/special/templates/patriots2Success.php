<?php use_stylesheet('special2.css') ?>
<?php slot(
  'title',
  sprintf($title))
?>
<script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
<script type="text/javascript" src="/js/special.js"></script>

<style>
    .home {
        background-image: url("../images/<?php echo $backgroundImage; ?>");
        background-size: cover;
        background-attachment: fixed;
    }
</style>


<div id="main">
    <div id="headline">
        Ride with other <?php echo $fansName; ?> to the next game. 
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
                <input class="formFields required" type="text" name="name" placeholder="First & Last Name"/>
                <input class="formFields required email" type="text" name="email" placeholder="Email"/>
                
                <select name="game" class="formFields required">
                    <?php foreach ($games as $game) : ?>
                        <option value="<?php echo $game['id']; ?>"><?php echo $game['displayName']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br />
                <input class="formFields required" type="text" name="location" placeholder="From: Address, City, State"/>
                <input id="destinationField" type="hidden" name="destination" value="<?php echo $destination; ?>" />
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