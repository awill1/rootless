<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $profile->getFullName()))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        var map = null;

        // Function when the page is ready
        $(document).ready(function(){
            // Make the tabs
            $( "#middleProfileDetails" ).tabs();

            // Google map loading
            var latlng = new google.maps.LatLng(<?php echo sfConfig::get('app_google_map_default_latitude') ?>, <?php echo sfConfig::get('app_google_map_default_longitude') ?>);
            var myOptions = {
                zoom: <?php echo sfConfig::get('app_google_map_default_zoom') ?>,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("travelMap"),
                myOptions);

            // Bind to the tabsshow event to resize the google map
            // This necessary work around is a side effect of the jquery ui
            // tabs. See
            // http://stackoverflow.com/questions/1428178/problems-with-google-maps-api-v3-jquery-ui-tabs
            $('#middleProfileDetails').bind('tabsshow', function(event, ui) {
                if (ui.panel.id == "fragment-travel_log") {
                    // Resize the map to fit the div size
                    google.maps.event.trigger(map, 'resize');
                    // Center the map
                    var mapCenter = new google.maps.LatLng(<?php echo sfConfig::get('app_google_map_default_latitude') ?>, <?php echo sfConfig::get('app_google_map_default_longitude') ?>);
                    map.setCenter(mapCenter);
                }
            });
        });
    </script>
<?php end_slot();?>
    
<div id="ProfileTopInfo">
        <h1 id="mainProfileTitle">
            <?php echo $profile->getFullName() ?>
            <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getPersonId() == $profile->getPersonId()): ?>
                <a id="mainProfileTitleEditLink" href="<?php echo url_for('profile_edit_user') ?>">Edit&nbsp;Profile</a>
            <?php endif ?>     
        </h1>
        <a id="mainProfileSubtitle" href="<?php echo $profile->getWebsiteUrl() ?>"><?php echo $profile->getWebsiteUrl() ?></a>
    <h2><?php echo $profile->getAge() ?> year old <?php echo $profile->getGender() ?> from
             <a id="mainProfileLocationLink" href="#" class="locationLink">+<?php echo $profile->getCity() ?></a></h2>
    <p>
        <?php echo $profile->getAboutMe() ?>
    </p>
    <h3 id="middleTop5">Top 5</h3>
    <p><?php  echo $profile->getTop5() ?></p>
    <span id="whereYouWannaGo"><?php echo $profile->getFirstName() ?> wants to go to <a href="#" class="locationLink">Bonneroo</a></span>
</div>
<div id="middleProfileBadge">
    <?php include_component('friendship', 'requestFriendshipButton', array('person_id' => $profile->getPersonId())) ?>
    <?php if(preg_match('/.*\.edu$/',$profile->getPeople()->getUsers()->getFirst()->getEmail())) : ?>
        <div id="studentVer">
            <img src="/images/check.png" alt="Verified Student" />
            Verified Student
        </div>
    <?php endif ?>
    <a href id="messageButtonLink">+ Message</a><br />
    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlLarge() ?>" alt="<?php echo $profile->getFullName() ?> profile picture"/>
    <div class="middleProfileBadgeInfo">
        Rides Given <strong><?php echo $travelSummary['ridesGiven'] ?></strong>
        Rides Received <strong><?php echo $travelSummary['ridesReceived'] ?></strong>
        </div>
</div>
   
<div id="profileDivider"><hr /></div>    
    

<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-feedback">Feedback</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-friends">Friends</a></li>
    </ul>
    <div id="fragment-feedback" class="middleProfileTabContent">

        <div id="testimonialsArea">
            <h3>Testimonials</h3>
            <hr />
            <?php include_component('review', 'reviews', array('profile_name' => $profile->getProfileName())) ?>  
        </div>
        <div id="reviewsArea">
            <?php include_partial('review/ratingGraphs', array('ratings' => $ratings)) ?>
            <span id="howmanyReviews">Based on 21 responses.</span>
        </div>
    </div>
    <div id="fragment-travel_log" class="middleProfileTabContent">
        <div id="travelMapArea" >
            <div id="travelMap" ></div>
            <div id="travelMapAreaTextCont">
                 <span class="travelmapCaption">20,398 miles traveled</span>
            </div>
        </div>
        <div id="carInfoArea">
            <h3>Car Info</h3>
            <p>
                <img src="/images/caricon.png" alt="car" />
                <?php echo $profile->getFirstName() ?>
                drives a <?php echo $vehicle ?>.
            </p>
        </div>
    </div>
    <div id="fragment-interests" class="middleProfileTabContent">
        <div id="interestsArea">
            <div class="middleProfileTabContentLeftColumn">
                <h3>Places you want to go</h3>
                <p>
                    <?php echo $profile->getWantsToTravelTo()?>
                </p>
                <h3>Music</h3>
                <p>
                    <?php echo $profile->getMusic() ?>
                </p>
                <h3>Movies</h3>
                <p>
                    <?php echo $profile->getMovies() ?>
                </p>
            </div>
            <div class="middleProfileTabContentRightColumn">

                    <h3>Books</h3>
                    <p>
                        <?php echo $profile->getBooks() ?>
                    </p>
                    <h3>Interests</h3>
                    <p>
                        <?php echo $profile->getInterests() ?>
                    </p>
                    <h3>Favorite Websites</h3>
                    <p>
                        <?php echo $profile->getFavoriteWebsites() ?>
                    </p>
            </div>
        </div>
    </div>
    <div id="fragment-friends" class="middleProfileTabContent">
        <div id="friendsArea">
            <h3>Rootless Favorites</h3>
                <ul class="middleFriendsList">
                <?php foreach ($friends as $friend): ?>
                    <li class="middleFriendsListItem"><span class="friendNameColor"> <a href="<?php echo $friend->getProfileName() ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $friend->getPictureUrlSmall() ?>" alt="<?php echo $friend->getFullName() ?>" /><br /><?php echo $friend->getFullName() ?></a></span></li>
                <?php endforeach; ?>
                </ul>
                <div class="middleFriendsListMore"></div>

                <?php if ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getPersonId() != $profile->getPersonId())): ?>
            <h3>Mutual Favorites</h3>
                <ul class="middleFriendsList">
                <?php foreach ($mutualFriends as $friend): ?>
                    <li class="middleFriendsListItem"><a href="<?php echo $friend->getProfileName() ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $friend->getPictureUrlSmall() ?>" alt="<?php echo $friend->getFullName() ?>" /></a></li>
                <?php endforeach; ?>
                </ul>
                <?php endif ?>
        </div>
    </div>
</div>
