<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_event')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Offer rides and find carpools to %s ', $event->getName()))
?>

<?php slot('gmapheader'); ?>
    <meta property="og:title" content="Rootless - Offer rides and find carpools to <?php echo $event->getName(); ?>"/>
    <meta property="og:description" content="Rootless is the carpooling solution to <?php echo $event->getName(); ?>. Find a ride or share the empty seats in your car."/>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_event'); ?>"></script>
    <script type="text/javascript" src="/js/custom-form-elements.js"></script>
    <script type="text/javascript">   
      $(document).ready(function(){

        $( ".datePicker" ).datepicker();  

        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'showEvent'});

       //the map object
        var map = Rootless.Map.Event.getInstance({
            mapId : 'map',
            el: {
                $originLatitude       : $("#rides_origin_latitude"),
                $originLongitude      : $("#rides_origin_longitude"),
                $destinationLatitude  : $("#rides_destination_latitude"),
                $destinationLongitude : $("#rides_destination_longitude")
            }
        });
        map.mapInit();
      });
    </script>
    <style>
        <?php echo htmlspecialchars_decode($event->getCssStyle()); ?>
    </style>
<?php end_slot();?>
<div id="eventHead">
    <div class="eventTitleText">Share a ride to <?php echo $event->getName() ?></div>
    <div class="eventSubheading"><?php echo $event->getSubheading() ?></div>
</div>
<div id="eventContent">
    <div id="headerAndLikeBox" >
        <span class="eventContentHeader">Post a ride</span>
        <div id="facebookLikeBox" >
            <div class="fb-like" data-href="http://www.facebook.com/rootlessme" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>
        </div>
    </div>
    <br/>
    <div id="leftWrap" class="blackbox">
        <div id="eventRideContainer">
            <div id="eventFormBox">
                    <?php include_partial('returnTripFormAlt', array('event' => $event)) ?>
            </div>
            <div id="eventRideConfirmationContainer">
                <h2>Yay! Your ride has been posted! Now what?</h2>
                <div id="rideOtherActionsContainer">
                    <a class="cta" href="<?php echo url_for('profile_edit_user'); ?>">Upload a photo</a>
                    <a id="confirmationPostAnotherRide" class="cta" href="#">Create another ride</a>
                </div>
            </div>
        </div>
    </div>
    <div id="rightWrap" class="blackboxSide">
        <div id="eventDetailsSection" >
            <div id="eventMapBox">
                <div id="map" >
            </div>
            <div id="mapCaption">
                <span class="strongSpan"><?php echo $event->getName() ?> |</span> <a href='<?php echo $event->getWebsiteUrl() ?>'><?php echo $event->getWebsiteUrl() ?></a>
                <br /><?php echo $event->getPlaces()->getLocation()->getAddressString(); ?>
            </div>
            </div>
            <div id="eventHowBox" class="helpBox">
                <h3>How it works</h3>
                <ol class="howtoList">
                    <li>
                        Fill out the form to the left with your ride details and post ride.
                    </li>
                    <li>
                        You will receive email updates when we find drivers and passengers along your route.
                    </li>
                    <li>
                        Once you find a driver or passenger, you will be able to negotiate on ride details until you come to an agreement.
                    </li>
                    <li>
                        Head to the event together!
                    </li>
                </ol>
                <h3>Questions</h3>
                <p>
                    Feel free to email us at <a href="mailto:contact@rootless.me?Subject=Question">contact@rootless.me</a> with any questions you might have!
                </p>
            </div>
        </div>
    </div>
    <div id="loginFormDialogContainer">
        <div id="registerFormContainer">
            <?php echo get_component('sfGuardAuth', 'ajaxSigninDialog'); ?>
        </div>
    </div>
</div>
