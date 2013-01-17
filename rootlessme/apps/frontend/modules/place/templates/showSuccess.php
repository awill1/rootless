<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Offer rides and find carpools to %s ', $place->getName()))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/map/Place.js"></script>
    <script type="text/javascript" src="/js/custom-form-elements.js"></script>
        <!-- facebook like button script -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
    <!-- end facebook like button script -->
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
    <style type="text/css">
        <?php echo htmlspecialchars_decode($place->getCssStyle()); ?>
    </style>
<?php end_slot();?>
<div id="placeHead">
    <div class="placeTitleText">Share a ride to <?php echo $place->getName() ?></div>
    <div id="placeLogo"></div>
</div>
<div id="placeContent">
    <div id="headerAndLikeBox" >
        <span class="placeContentHeader">Post a ride</span>
        <div id="facebookLikeBox" >
            <div class="fb-like" data-href="http://www.facebook.com/rootlessme" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>
        </div>
    </div>
    <br/>
    <div id="placeRideContainer" >
        <div id="placeFormBox">
                <?php include_partial('returnTripFormAlt', array('place' => $place)) ?>
        </div>
        <div id="placeRideConfirmationContainer">
            <h2>Yay! Your ride has been posted! Now what?</h2>
            <ul id="placeCreatedRidesList">
                
            </ul>
            
            <p>Share with your friends, they might
            be heading to the mountain too!</p>
            <div id="rideShareButtonsContainer" >
                Send Tweet
            </div>
            <p>or</p>
            <div id="rideOtherActionsContainer">
                <a href="<?php echo url_for('profile_edit_user'); ?>">Upload a photo</a>
                <a id="confirmationPostAnotherRide" href="#">Create another ride</a>
            </div>
        </div>
    </div>
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
    <div id="loginFormDialogContainer">
        <h1>Login Dialog</h1>
        <div id="registerFormContainer">
            <?php echo get_component('sfGuardAuth', 'ajaxSigninDialog'); ?>
        </div>
    </div>
</div>
