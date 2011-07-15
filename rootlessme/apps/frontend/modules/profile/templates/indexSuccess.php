<?php use_stylesheet('profile.css') ?>

<h1>Travelers</h1>

<div id="middleFeaturedTraveler">
    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?>profile_aaron_large.jpg" alt="Aaron Williams" />
    <div class="imageCaption">Featured Traveler: Aaron Williams</div>
</div>

<div id="middleSearchTravelers">
    <h2>Search travelers!</h2>
    <form class="userInputForm" action="profileSearch.php">
        <input type="textbox" value="Who do you know?" />
        <input type="submit" value="find" />
    </form>
    <ul id="travelersList">
        <?php foreach ($profiles as $profile): ?>
        <li class="travelersListItem">
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>" alt="<?php echo $profile->getFullName() ?>" />
            <br />
            <a href="<?php echo url_for('profile_show_user', array('profile_name'=>$profile->getProfileName())) ?>">
                <?php echo $profile->getFullName() ?>
            </a>
            <br />
            <?php echo $profile->getCity() ?>, <?php echo $profile->getState() ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

