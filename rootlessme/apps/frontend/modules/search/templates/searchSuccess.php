<?php use_stylesheet('search.css') ?>

<h1>Search Results</h1>


<div id="travelersSection">
<h3>Travelers</h3>

<ul>
    <?php foreach ($profiles as $profile): ?>
        <li id ="userName"><img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>"  alt="<?php echo $profile->getFullName() ?>" /><br/><a href="<?php echo url_for('profile_show_user', array('profile_name'=>$profile->getProfileName())) ?>"><?php echo $profile->getFullName() ?> </a></li>
    <?php endforeach; ?>
</ul>

</div>

<div id="rideSection">

<h3>Rides</h3>

</div>