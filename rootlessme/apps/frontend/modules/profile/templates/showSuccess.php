<?php use_stylesheet('profile.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s %s', $profiles->getFirstname(), $profiles->getLastname()))
?>

<h1 id="mainProfileTitle"><?php echo $profiles->getFirstname() ?> <?php echo $profiles->getLastname() ?> <a id="mainProfileTitleEditLink" href="#">Edit&nbsp;Profile</a></h1>
<a id="mainProfileSubtitle" href="<?php echo $profiles->getWebsiteurl() ?>"><?php echo $profiles->getWebsiteurl() ?></a>

<div id="middleProfileBadge">
    <img src="<?php echo $profiles->getPictureurllarge() ?>" alt="<?php echo $profiles->getFirstname() ?> <?php echo $profiles->getLastname() ?> profile picture"/>
    <div class="middleProfileBadgeInfo">Rides Given <strong>10</strong> Rides Received <strong>38</strong> <a href="#"><img src="/images/messageButton.JPG" alt="Message" /></a></div>
</div>
     <h2><?php echo $profiles->getBirthday() ?> year old <?php echo $profiles->getGender() ?> from
         <a id="mainProfileLocationLink" href="#" class="locationLink">+<?php echo $profiles->getCity() ?></a></h2>
<p>
    <?php echo $profiles->getAboutme() ?>
</p>
<h3 id="middleTop5">Top 5</h3>
<p><?php echo $profiles->getTop5() ?></p>

<h3><?php echo $profiles->getFirstname() ?> wants to go to <a href="#" class="locationLink">Bonneroo</a></h3>


<div id="middleProfileDetails">
    <ul class="tabList">
        <li class="tabSelectedItem"><a href="#fragment-id">I.D.</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-travel_log">Travel Log</a></li>
        <li class="tabNotSelectedItem"><a href="#fragment-interests">Interests</a></li>
    </ul>
    <div id="fragment-id" class="middleProfileTabContent">

        <div class="middleProfileTabContentLeftColumn">

            <p><img src="carPicture.JPG" alt="My car" /><?php echo $profiles->getFirstname() ?> drives a Mercury Cougar 2000s Series 1000.</p>

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
                <?php echo $profiles->getWantstotravelto() ?>
            </p>
            <h3>Music</h3>
            <p>
                <?php echo $profiles->getMusic() ?>
            </p>
            <h3>Movies</h3>
            <p>
                <?php echo $profiles->getMovies() ?>
            </p>
        </div>
        <div class="middleProfileTabContentRightColumn">
            <h3>Books</h3>
            <p>
                <?php echo $profiles->getBooks() ?>
            </p>
            <h3>Interests</h3>
            <p>
                <?php echo $profiles->getInterests() ?>
            </p>
            <h3>Favorite Websites</h3>
            <p>
                <?php echo $profiles->getFavoritewebsites() ?>
            </p>
        </div>
    </div>
</div>



















<table>
  <tbody>
    <tr>
      <th>Idprofile:</th>
      <td><?php echo $profiles->getIdprofile() ?></td>
    </tr>
    <tr>
      <th>Firstname:</th>
      <td><?php echo $profiles->getFirstname() ?></td>
    </tr>
    <tr>
      <th>Lastname:</th>
      <td><?php echo $profiles->getLastname() ?></td>
    </tr>
    <tr>
      <th>Pictureurl:</th>
      <td><?php echo $profiles->getPictureurl() ?></td>
    </tr>
    <tr>
      <th>Pictureurllarge:</th>
      <td><?php echo $profiles->getPictureurllarge() ?></td>
    </tr>
    <tr>
      <th>Pictureurlmedium:</th>
      <td><?php echo $profiles->getPictureurlmedium() ?></td>
    </tr>
    <tr>
      <th>Pictureurlsmall:</th>
      <td><?php echo $profiles->getPictureurlsmall() ?></td>
    </tr>
    <tr>
      <th>Pictureurltiny:</th>
      <td><?php echo $profiles->getPictureurltiny() ?></td>
    </tr>
    <tr>
      <th>Address1:</th>
      <td><?php echo $profiles->getAddress1() ?></td>
    </tr>
    <tr>
      <th>Address2:</th>
      <td><?php echo $profiles->getAddress2() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $profiles->getCity() ?></td>
    </tr>
    <tr>
      <th>State:</th>
      <td><?php echo $profiles->getState() ?></td>
    </tr>
    <tr>
      <th>Postalcode:</th>
      <td><?php echo $profiles->getPostalcode() ?></td>
    </tr>
    <tr>
      <th>Country:</th>
      <td><?php echo $profiles->getCountry() ?></td>
    </tr>
    <tr>
      <th>Birthday:</th>
      <td><?php echo $profiles->getBirthday() ?></td>
    </tr>
    <tr>
      <th>Gender:</th>
      <td><?php echo $profiles->getGender() ?></td>
    </tr>
    <tr>
      <th>Aboutme:</th>
      <td><?php echo $profiles->getAboutme() ?></td>
    </tr>
    <tr>
      <th>Top5:</th>
      <td><?php echo $profiles->getTop5() ?></td>
    </tr>
    <tr>
      <th>Wantstotravelto:</th>
      <td><?php echo $profiles->getWantstotravelto() ?></td>
    </tr>
    <tr>
      <th>Music:</th>
      <td><?php echo $profiles->getMusic() ?></td>
    </tr>
    <tr>
      <th>Movies:</th>
      <td><?php echo $profiles->getMovies() ?></td>
    </tr>
    <tr>
      <th>Books:</th>
      <td><?php echo $profiles->getBooks() ?></td>
    </tr>
    <tr>
      <th>Interests:</th>
      <td><?php echo $profiles->getInterests() ?></td>
    </tr>
    <tr>
      <th>Favoritewebsites:</th>
      <td><?php echo $profiles->getFavoritewebsites() ?></td>
    </tr>
    <tr>
      <th>Websiteurl:</th>
      <td><?php echo $profiles->getWebsiteurl() ?></td>
    </tr>
    <tr>
      <th>Facebookusername:</th>
      <td><?php echo $profiles->getFacebookusername() ?></td>
    </tr>
    <tr>
      <th>Twitterusername:</th>
      <td><?php echo $profiles->getTwitterusername() ?></td>
    </tr>
    <tr>
      <th>Createdon:</th>
      <td><?php echo $profiles->getCreatedon() ?></td>
    </tr>
    <tr>
      <th>Modifiedon:</th>
      <td><?php echo $profiles->getModifiedon() ?></td>
    </tr>
    <tr>
      <th>Users username:</th>
      <td><?php echo $profiles->getUsersUsername() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('profile/edit?idprofile='.$profiles->getIdprofile()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('profile/index') ?>">List</a>
<!--<a href="<?php echo url_for('profile/index') ?>">List</a>-->
