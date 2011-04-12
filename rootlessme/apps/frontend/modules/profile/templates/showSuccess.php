<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s %s', $profile->getFirstName(), $profile->getLastName()))
?>

<h1 id="mainProfileTitle"><?php echo $profile->getFirstName() ?> <?php echo $profile->getLastName() ?> <a id="mainProfileTitleEditLink" href="#">Edit&nbsp;Profile</a></h1>
<a id="mainProfileSubtitle" href="<?php echo $profile->getWebsiteUrl() ?>"><?php echo $profile->getWebsiteUrl() ?></a>

<div id="middleProfileBadge">
    <img src="<?php echo $profile->getPictureUrlLarge() ?>" alt="<?php echo $profile->getFirstName() ?> <?php echo $profile->getLastName() ?> profile picture"/>
    <div class="middleProfileBadgeInfo">Rides Given <strong>10</strong> Rides Received <strong>38</strong> <a href="#"><img src="/images/messageButton.JPG" alt="Message" /></a></div>
</div>
     <h2><?php echo $profile->getBirthday() ?> year old <?php echo $profile->getGender() ?> from
         <a id="mainProfileLocationLink" href="#" class="locationLink">+<?php echo $profile->getCity() ?></a></h2>
<p>
    <?php echo $profile->getAboutMe() ?>
</p>
<h3 id="middleTop5">Top 5</h3>
<p><?php // echo $profiles->getTop5() ?></p>

<h3><?php echo $profile->getFirstName() ?> wants to go to <a href="#" class="locationLink">Bonneroo</a></h3>


<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-id">I.D.</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
    </ul>
    <div id="fragment-id" class="middleProfileTabContent">

        <div class="middleProfileTabContentLeftColumn">

            <p><img src="carPicture.JPG" alt="My car" /><?php echo $profile->getFirstName() ?> drives a Mercury Cougar 2000s Series 1000.</p>

            <h3>Rootless Me Friends</h3>
            <ul class="middleFriendsList">
                <li class="middleFriendsListItem"><a href="profile_aaron"><img src="lauren_profile_small.JPG" alt="Aaron Williams" /></a></li>
                <li class="middleFriendsListItem"><a href="profile_christy"><img src="lauren_profile_small.JPG" alt="Christy Williams" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
            </ul>
            <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>

            <h3>Mutual Friends</h3>
            <ul class="middleFriendsList">
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
                <li class="middleFriendsListItem"><a href="#"><img src="lauren_profile_small.JPG" alt="Friend1" /></a></li>
            </ul>
            <div class="middleFriendsListMore"><a class="seeMoreLink" href="#">&gt;&gt;see more</a></div>

            <ul>
                <li><a href="#"></a></li>
            </ul>


        </div>
        <div class="middleProfileTabContentRightColumn">
            <div id="DriverRatingSummary">
                <ul id="feedbackSummaryList">
                    <li class="feedbackSummaryListItem"><div id="safeDriverRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: 10%;">10%</div></div><div class="feedbackRatingBarLabel">Safe Driver</div></li>
                    <li class="feedbackSummaryListItem"><div id="puncualityRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: 100%;">100%</div></div><div class="feedbackRatingBarLabel">Punctuality</div></li>
                    <li class="feedbackSummaryListItem"><div id="friendlinessRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: 56%;">56%</div></div><div class="feedbackRatingBarLabel">Friendliness</div></li>
                    <li class="feedbackSummaryListItem"><div id="goodRiderRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: 73%;">73%</div></div><div class="feedbackRatingBarLabel">Good Rider</div></li>
                </ul>
            </div>
            <div id="driverReviews">
                <div id="driverReviewsViewBox"><a class="actionLink" href="#" >View Testimonials</a></div>
                <ul id="driverReviewsList">
                    <li class="driverReviewsListItem">
                        <img class="feedbackProfilePicture" src="lauren_profile_small.JPG" alt="Janet Dickenson" />
                        <h3 class="feedbackProfileHeading">Janet Dickenson</h3>
                        <p class="feedbackProfileComment">
                            Had a great experience riding to Johnstown! Laurenzeeno
                            was friendly and fun! Recommend to anyone as a driver or
                            passenger! Had a great experience riding to Johnstown!
                            Laurenzeeno was friendly and fun! Recommend to anyone
                            as a driver or passenger!
                        </p>
                        <div class="feedbackProfileReply"><a class="actionLink" href="#" >Reply</a></div>
                    </li>
                    <li class="driverReviewsListItem">
                        <img class="feedbackProfilePicture" src="lauren_profile_small.JPG" alt="Janet Dickenson" />
                        <h3 class="feedbackProfileHeading">Janet Dickenson</h3>
                        <p class="feedbackProfileComment">
                            Had a great experience riding to Johnstown! Laurenzeeno
                            was friendly and fun! Recommend to anyone as a driver or
                            passenger!
                        </p>
                        <div class="feedbackProfileReply"><a class="actionLink" href="#" >Reply</a></div>
                        <div ><textarea class="replyTextarea" cols="19" rows="5"></textarea></div>
                    </li>
                    <li class="driverReviewsListItem">
                        <img class="feedbackProfilePicture" src="lauren_profile_small.JPG" alt="Janet Dickenson" />
                        <h3 class="feedbackProfileHeading">Janet Dickenson</h3>
                        <p class="feedbackProfileComment">
                            Had a great experience riding to Johnstown! Laurenzeeno
                            was friendly and fun! Recommend to anyone as a driver or
                            passenger!
                        </p>
                        <div class="feedbackProfileReply"><a class="actionLink" href="#" >Reply</a></div>
                    </li>
                </ul>
            </div>
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
</div>













<table>
  <tbody>
    <tr>
      <th>Profile name:</th>
      <td><?php echo $profile->getProfileName() ?></td>
    </tr>
    <tr>
      <th>Person:</th>
      <td><?php echo $profile->getPersonId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $profile->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $profile->getLastName() ?></td>
    </tr>
    <tr>
      <th>Picture url:</th>
      <td><?php echo $profile->getPictureUrl() ?></td>
    </tr>
    <tr>
      <th>Picture url large:</th>
      <td><?php echo $profile->getPictureUrlLarge() ?></td>
    </tr>
    <tr>
      <th>Picture url medium:</th>
      <td><?php echo $profile->getPictureUrlMedium() ?></td>
    </tr>
    <tr>
      <th>Picture url small:</th>
      <td><?php echo $profile->getPictureUrlSmall() ?></td>
    </tr>
    <tr>
      <th>Picture url tiny:</th>
      <td><?php echo $profile->getPictureUrlTiny() ?></td>
    </tr>
    <tr>
      <th>Address 1:</th>
      <td><?php //echo $profile->getAddress1() ?></td>
    </tr>
    <tr>
      <th>Address 2:</th>
      <td><?php // echo $profile->getAddress2() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $profile->getCity() ?></td>
    </tr>
    <tr>
      <th>State:</th>
      <td><?php echo $profile->getState() ?></td>
    </tr>
    <tr>
      <th>Postal code:</th>
      <td><?php echo $profile->getPostalCode() ?></td>
    </tr>
    <tr>
      <th>Country:</th>
      <td><?php echo $profile->getCountry() ?></td>
    </tr>
    <tr>
      <th>Birthday:</th>
      <td><?php echo $profile->getBirthday() ?></td>
    </tr>
    <tr>
      <th>Gender:</th>
      <td><?php echo $profile->getGender() ?></td>
    </tr>
    <tr>
      <th>About me:</th>
      <td><?php echo $profile->getAboutMe() ?></td>
    </tr>
    <tr>
      <th>Top 5:</th>
      <td><?php // echo $profile->getTop5() ?></td>
    </tr>
    <tr>
      <th>Wants to travel to:</th>
      <td><?php echo $profile->getWantsToTravelTo() ?></td>
    </tr>
    <tr>
      <th>Music:</th>
      <td><?php echo $profile->getMusic() ?></td>
    </tr>
    <tr>
      <th>Movies:</th>
      <td><?php echo $profile->getMovies() ?></td>
    </tr>
    <tr>
      <th>Books:</th>
      <td><?php echo $profile->getBooks() ?></td>
    </tr>
    <tr>
      <th>Interests:</th>
      <td><?php echo $profile->getInterests() ?></td>
    </tr>
    <tr>
      <th>Favorite websites:</th>
      <td><?php echo $profile->getFavoriteWebsites() ?></td>
    </tr>
    <tr>
      <th>Website url:</th>
      <td><?php echo $profile->getWebsiteUrl() ?></td>
    </tr>
    <tr>
      <th>Facebook user name:</th>
      <td><?php echo $profile->getFacebookUserName() ?></td>
    </tr>
    <tr>
      <th>Twitter user name:</th>
      <td><?php echo $profile->getTwitterUserName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $profile->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $profile->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('profile/edit?profile_name='.$profile->getProfileName()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('profile/index') ?>">List</a>
