<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s', $profile->getFullName()))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript">
        $(function() {
            $( "#middleProfileDetails" ).tabs();
	});
    </script>
<?php end_slot();?>

<h1 id="mainProfileTitle">
    <?php echo $profile->getFullName() ?>
    <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getPersonId() == $profile->getPersonId()): ?>
        <a id="mainProfileTitleEditLink" href="<?php echo url_for('profile_edit_user') ?>">Edit&nbsp;Profile</a>
    <?php endif ?>     
    <?php include_component('friendship', 'requestFriendshipButton', array('person_id' => $profile->getPersonId())) ?>
</h1>
<a id="mainProfileSubtitle" href="<?php echo $profile->getWebsiteUrl() ?>"><?php echo $profile->getWebsiteUrl() ?></a>
<div id="middleProfileBadge">
    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlLarge() ?>" alt="<?php echo $profile->getFullName() ?> profile picture"/>
    <div class="middleProfileBadgeInfo">
        Rides Given <strong><?php echo $travelSummary['ridesGiven'] ?></strong>
        Rides Received <strong><?php echo $travelSummary['ridesReceived'] ?></strong>
        <a href="#"><img src="/images/messageButton.JPG" alt="Message" /></a></div>
</div>
     <h2><?php echo $profile->getAge() ?> year old <?php echo $profile->getGender() ?> from
         <a id="mainProfileLocationLink" href="#" class="locationLink">+<?php echo $profile->getCity() ?></a></h2>
<p>
    <?php echo $profile->getAboutMe() ?>
</p>
<h3 id="middleTop5">Top 5</h3>
<p><?php  echo $profile->getTop5() ?></p>

<h3><?php echo $profile->getFirstName() ?> wants to go to <a href="#" class="locationLink">Bonneroo</a></h3>

<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-feedback">Feedback</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-friends">Friends</a></li>
    </ul>
    <div id="fragment-feedback" class="middleProfileTabContent">

        <div class="testimonialsArea">
            Testimonials
            



        </div>
        <div class="reviewsArea">
                Reviews
                
                <?php include_component('review', 'reviews', array('profile_name' => $profile->getProfileName())) ?>

               
        </div>
    </div>
    <div id="fragment-travel_log" class="middleProfileTabContent">
        <h3>Travel Log</h3>
        <div id="travelMapArea" > 
            <span class="travelmapCaption"474646373 Miles Traveled</span>
            </div>
        <div id="carInfoArea">
            <h3>Car Info</h3>
            <p>
                <img src="carPicture.JPG" alt="My car" />
                <?php echo $profile->getFirstName() ?>
                drives a <?php echo $vehicle ?>.
            </p>
        </div>
        <div id="upcomingArea">
            <h3>Upcoming</h3>
            <ul>
                <li>Cincinnati</li>
                <li>Cleveland</li>
                <li>Columbus</li>
            </ul>
        </div>
        <div id="pastEventsArea">
             <h3>Past Events</h3>
            <ul>
                <li>Super Bowl</li>
                <li>Sun Country</li>
                <li>Burning Man</li>
                <li>Bonnaroo</li>
                <li>Taste of Chicago</li>
            </ul>
        </div>
    </div>
    <div id="fragment-interests" class="middleProfileTabContent">
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
    <div id="fragment-friends" class="middleProfileTabContent">
        <h3>Rootless Friends</h3>
            <ul class="middleFriendsList">
            <?php foreach ($friends as $friend): ?>
                <li class="middleFriendsListItem"><a href="<?php echo $friend->getProfileName() ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $friend->getPictureUrlSmall() ?>" alt="<?php echo $friend->getFullName() ?>" /></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>

            <?php if ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getPersonId() != $profile->getPersonId())): ?>
        <h3>Mutual Friends</h3>
            <ul class="middleFriendsList">
            <?php foreach ($mutualFriends as $friend): ?>
                <li class="middleFriendsListItem"><a href="<?php echo $friend->getProfileName() ?>"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $friend->getPictureUrlSmall() ?>" alt="<?php echo $friend->getFullName() ?>" /></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>
            <?php endif ?>
    </div>
</div>
