<h3 class="leftWidgetTitle">Traveling With</h3>
<ul id="leftActivityList">
    <?php foreach($relatedPassengers as $relatedPassenger) : ?>
        <li class="leftActivityItem">
            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>" alt="<?php echo $sf_user->getGuardUser()->getPeople(); ?>" />
            <span class="travelingWith">Colin Hoell</span>
            <br/>
            <a href="<?php echo url_for("profile_show_user", $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst())  ?>" id="leftProfileViewLink" >View Ride</a>
        </li>
        <br/>
    <?php endforeach; ?>
</ul>
