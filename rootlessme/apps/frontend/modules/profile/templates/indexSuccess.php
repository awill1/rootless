<?php use_stylesheet('profile.css') ?>

<h1>Travelers</h1>

<div id="middleFeaturedTraveler">
    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?>profile_aaron_large.jpg" alt="Aaron Williams" />
    <div class="imageCaption">Featured Traveler <br/> <span class ="imageCaptionName"> Aaron Williams</span></div>
</div>
    <form class="userInputForm" action="profileSearch.php">
        <input class="searchPeople" type="textbox" value="Search Travelers..." onblur="if (this.value == ''){this.value = 'Search Travelers...';}" onfocus="if(this.value == 'Search Travelers...'){this.value='';}"/>
        <input class="searchSubmit" type="submit" value="find" />
    </form>
<div class="middleSearchTravelers">
    <div class="SearchTravelerTitle"">People You May Know</div>
    <div class="travelersList">
        <?php foreach ($profiles as $profile): ?>
        <div class="travelersListItem">
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall() ?>"  alt="<?php echo $profile->getFullName() ?>" />
            <br />
            <a href="<?php echo url_for('profile_show_user', array('profile_name'=>$profile->getProfileName())) ?>">
        </div>
             <div class="travelerInformation">       
                <span class="travelerListName"><?php echo $profile->getFullName() ?></span>
                
                <span class="travelerHomeTown"><?php echo $profile->getCity() ?>, <?php echo $profile->getState() ?></span>
            </div>
        <?php endforeach; ?>
    </ul>
</div>

