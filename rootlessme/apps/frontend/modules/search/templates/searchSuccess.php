<?php use_stylesheet(sfConfig::get('app_css_search')) ?>

<h1>Search Results</h1>

<div id="travelersSection">
    <h3>Travelers</h3>
    <div class="searchResults">
        <?php if ($profiles->count() == 0): ?>
            No travelers found.
        <?php else: ?>
            <ul class="searchResultsList">
                <?php foreach ($profiles as $profile): ?>
                    <li class="userName">
                        <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>"  alt="<?php echo $profile->getFullName() ?>" />
                        <br/>
                        <a href="<?php echo url_for('profile_show_user', array('profile_name'=>$profile->getProfileName())) ?>"><?php echo $profile->getFullName() ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<div id="rideSection">
    <h3>Rides</h3>
    <div class="searchResults">No rides found. <a href="<?php echo url_for('ride_new', array('ride_type'=>'offer')) ?>">Offer a ride</a> 
        or 
        <a href="<?php echo url_for('ride_new', array('ride_type'=>'request')) ?>">Request a ride</a>. 
        Then other people will be able to find you!</div>  
</div>