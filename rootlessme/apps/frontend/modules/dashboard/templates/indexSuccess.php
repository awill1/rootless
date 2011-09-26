<?php use_stylesheet('dashboard.css') ?>

<h1>Dashboard</h1>
<div id="rideSection">
    <h3>Rides</h3>
    <div id="rideInformationDashLeft">
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
    </div>
    <div id="rideInformationDashRight">
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
        <div class="rideCont"><div class="dateCont"><div class="monthCont">JAN</div><div class="dayCont">1</div><div class="timeCont">9:00 AM</div></div>+ Columbus, OH <br /> <span class="viewRideLink">View Ride</span></div>
    </div>
</div>
<div id="quickRidesBox">
    <h3>Requests/Offers</h3>
    <div id="quickBoxItem">
        <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
        <p id="quickBoxName">Aaron Williams </p>
        <p id="quickBoxLocationStart">+Cincinnati</p>
        <p id="quickBoxLocationFinish">+Columbus</p>
        <p id="quickBoxConfirmButton">Confirm</p>
        <p id="quickBoxDeclineButton">Decline</p>
        <hr>
        <p id="quickBoxViewRequestButton">view request</p>
        <hr>
    </div>
    <div id="quickBoxItem">
        <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
        <p id="quickBoxName">Aaron Williams </p>
        <p id="quickBoxLocationStart">+Cincinnati</p>
        <p id="quickBoxLocationFinish">+Columbus</p>
        <p id="quickBoxConfirmButton">Confirm</p>
        <p id="quickBoxDeclineButton">Decline</p>
        <hr>
        <p id="quickBoxViewRequestButton">view request</p>
        <hr>
    </div>
    <div id="quickBoxItem">
        <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
        <p id="quickBoxName">Aaron Williams </p>
        <p id="quickBoxLocationStart">+Cincinnati</p>
        <p id="quickBoxLocationFinish">+Columbus</p>
        <p id="quickBoxConfirmButton">Confirm</p>
        <p id="quickBoxDeclineButton">Decline</p>
        <hr>
        <p id="quickBoxViewRequestButton">view request</p>
        <hr>
    </div>
    <div id="quickBoxItem">
        <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
        <p id="quickBoxName">Aaron Williams </p>
        <p id="quickBoxLocationStart">+Cincinnati</p>
        <p id="quickBoxLocationFinish">+Columbus</p>
        <p id="quickBoxConfirmButton">Confirm</p>
        <p id="quickBoxDeclineButton">Decline</p>
        <hr>
        <p id="quickBoxViewRequestButton">view request</p>
        <hr>
    </div>
</div>
<div id="feedSection">
    <h3>Feed</h3>
    <div id="feedObject">
    <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
    <p id="feedCopyObjects"> Aaron Williams </p> is riding with <p id="feedCopyObjects"> Christy Williams </p> to +Denver Colorado. blah blah blah blah blah blah<p id="feedRiders"> 2 Seats Available </p>
    <p id="feedTime"> 30 minutes ago </p>
    </div>
        <div id="feedObject">
    <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
    <p id="feedCopyObjects"> Aaron Williams </p> is riding with <p id="feedCopyObjects"> Christy Williams </p> to +Denver Colorado blah blah blah blah balh blah blah blah blah blah blah blah blah blah blah blah blah. <p id="feedTime"> 30 minutes ago </p>
    </div>
        <div id="feedObject">
    <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
    <p id="feedCopyObjects"> Aaron Williams </p> is riding with <p id="feedCopyObjects"> Christy Williams </p> to +Denver Colorado. <p id="feedRiders"> 2 Seats Available </p>
    </div>
        <div id="feedObject">
    <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
    <p id="feedCopyObjects"> Aaron Williams </p> is riding with <p id="feedCopyObjects"> Christy Williams </p> to +Denver Colorado. <p id="feedRiders"> 2 Seats Available </p>
    </div>
</div>