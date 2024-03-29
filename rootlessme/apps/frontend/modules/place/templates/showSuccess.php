<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Offer rides and find carpools to %s ', $place->getName()))
?>

<?php slot('gmapheader'); ?>
    <meta property="og:title" content="Rootless - Offer rides and find carpools to <?php echo $place->getName(); ?>"/>
    <meta property="og:description" content="Rootless is the carpooling solution to <?php echo $place->getName(); ?>. Find a ride or share the empty seats in your car."/>
    <?php  if ($place->getShareImageUrl() != null): ?>
    <meta property="og:image" content="<?php echo $place->getShareImageUrl() ?>"/>
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_place'); ?>"></script>
    <script type="text/javascript" src="/js/custom-form-elements.js"></script>
    <script type="text/javascript">   
      $(document).ready(function(){

        $( ".datePicker" ).datepicker();  

        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'showPlace'});

       //the map object
        var map = Rootless.Map.Place.getInstance({
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
        <?php echo htmlspecialchars_decode($place->getCssStyle()); ?>
    </style>
<?php end_slot();?>
<div id="placeHead">
    <div class="placeTitleText">Share a ride to <?php echo $place->getName() ?></div>
</div>
<div id="placeContent">
    <div id="headerAndLikeBox" >
        <span class="placeContentHeader">Post a ride</span>
        <div id="facebookLikeBox" >
            <div class="fb-like" data-href="http://www.facebook.com/rootlessme" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>
        </div>
    </div>
    <br/>
    <div id="leftWrap" class="borderLeft">
        <div id="placeRideContainer" >
            <div id="placeFormBox">
                    <?php include_partial('returnTripFormAlt', array('place' => $place)) ?>
            </div>
            <div id="placeRideConfirmationContainer">
                <h2>Yay! Your ride has been posted! Now what?</h2>
                <div id="rideOtherActionsContainer">
                    <a class="cta" href="<?php echo url_for('profile_edit_user'); ?>">Upload a photo</a>
                    <a id="confirmationPostAnotherRide" class="cta" href="#">Create another ride</a>
                </div>
            </div>
        </div>
    </div>
    <div id="rightWrap" class="borderRight">
        <div id="placeDetailsSection" >
            <div id="placeMapBox">
                <div id="map" >
            </div>
            <div id="mapCaption">
                <span class="strongSpan"><?php echo $place->getName() ?> |</span> <a href='<?php echo $place->getWebsiteUrl() ?>'><?php echo $place->getWebsiteUrl() ?></a>
                <br /><?php echo $place->getLocation()->getAddressString(); ?>
            </div>
            </div>
            <div id="placeHowBox" class="helpBox">
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
                        Head to the mountain together!
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
