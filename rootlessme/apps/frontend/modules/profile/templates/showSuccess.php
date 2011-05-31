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
        <li class="tabSelectedItem"><a href="#fragment-id">I.D.</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
    </ul>
    <div id="fragment-id" class="middleProfileTabContent">

        <div class="middleProfileTabContentLeftColumn">
            <h3>Vehicle</h3>
            <p>
                <img src="carPicture.JPG" alt="My car" />
                <?php echo $profile->getFirstName() ?>
                drives a <?php echo $vehicle ?>.
            </p>

            <h3>Rootless Me Friends</h3>
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
        <div class="middleProfileTabContentRightColumn">
            <div id="DriverRatingSummary">
                <ul id="feedbackSummaryList">
                    <li class="feedbackSummaryListItem"><div id="safeDriverRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['safetyAverage']) ?>%;"><?php echo round($ratings['safetyAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Safe Driver</div></li>
                    <li class="feedbackSummaryListItem"><div id="puncualityRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['punctualityAverage']) ?>%;"><?php echo round($ratings['punctualityAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Punctuality</div></li>
                    <li class="feedbackSummaryListItem"><div id="friendlinessRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['friendlinessAverage']) ?>%;"><?php echo round($ratings['friendlinessAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Friendliness</div></li>
                    <li class="feedbackSummaryListItem"><div id="goodRiderRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['riderAverage']) ?>%;"><?php echo round($ratings['riderAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Good Rider</div></li>
                </ul>
            </div>
            <div id="driverReviews">
                <div id="driverReviewsViewBox"><a class="actionLink" href="#" >View Testimonials</a></div>
                <?php if ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getPersonId() != $profile->getPersonId())): ?>
                <?php include_partial('profile/reviews', array('form' => $reviewForm, 'option' => true)) ?>
                <?php endif ?>
                <ul id="driverReviewsList">
                    <?php foreach ($reviews as $review): ?>
                     <li class="driverReviewsListItem">
                         <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>">
                             <img class="feedbackProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $review->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall() ?>" alt="<?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>" />
                         </a>
                        <h3 class="feedbackProfileHeading">         
                          <a href="<?php echo $review->getPeople()->getProfiles()->getFirst()->getProfileName() ?>">
                            <?php echo $review->getPeople()->getProfiles()->getFirst()->getFullName() ?>
                          </a>
                        </h3>
                        <p class="feedbackProfileComment">
                            <?php echo $review->getComments() ?>
                        </p>
                        <div class="feedbackProfileReply"><a class="actionLink" href="#" >Reply</a></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>
            </div>
        </div>
    </div>
    <div id="fragment-travel_log" class="middleProfileTabContent">
        <h3>Travel Log</h3>
        
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
</div>
