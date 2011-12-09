<h3 class="leftWidgetTitle">Traveling With</h3>
<?php if ($travelingCompanions->count() == 0): ?>
    <div>No upcoming confirmed travel companions</div>  
<?php else: ?>
    <ul id="leftActivityList">
        <?php foreach($travelingCompanions as $travelingCompanion) : ?>
            <li class="leftActivityItem">
                <a href="<?php echo url_for("profile_show_user", array('profile_name'=>$travelingCompanion->getProfileName()))  ?>">
                <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $travelingCompanion->getPictureUrlSmall(); ?>" alt="<?php echo $travelingCompanion->getFullName() ?>" />
                <span class="travelingWith"><?php echo $travelingCompanion->getFullName() ?></span>
                <br/>
                </a>
            </li>
            <br/>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
