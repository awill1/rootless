<?php use_stylesheet('dashboard.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Dashboard'))
?>

<h1>Dashboard</h1>
<div id="rideSection">
    <h3>Rides</h3>
    <div id="rideInformationDashLeft">
        <h3>Offers</h3>
        <?php foreach ($carpools as $carpool): ?>
            <div class="rideCont">
                <div class="dateCont">
                    <div class="monthCont"><?php echo date("M",strtotime($carpool->getStartDate())) ?></div>
                    <div class="dayCont"><?php echo date("j",strtotime($carpool->getStartDate())) ?></div>
                    <div class="timeCont"><?php echo date("g:i A",strtotime($carpool->getStartTime())) ?></div>
                </div>
                +<?php echo $carpool->getOriginLocation() ?><br /> 
                +<?php echo $carpool->getDestinationLocation() ?><br /> 
                <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>" >View Ride</a>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="rideInformationDashRight">
        <h3>Requests</h3>
        <?php foreach ($passengers as $passenger): ?>
            <div class="rideCont">
                <div class="dateCont">
                    <div class="monthCont"><?php echo date("M",strtotime($passenger->getStartDate())) ?></div>
                    <div class="dayCont"><?php echo date("j",strtotime($passenger->getStartDate())) ?></div>
                    <div class="timeCont"><?php echo date("g:i A",strtotime($passenger->getStartTime())) ?></div>
                </div>
                +<?php echo $passenger->getOriginLocation() ?><br /> 
                +<?php echo $passenger->getDestinationLocation() ?><br /> 
                <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'request', 'ride_id' => $passenger->getPassengerId())) ?>" >View Ride</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div id="quickRidesBox">
    <h3>Offers</h3>
    <?php foreach ($driverSeats as $driverSeat): ?>
        <div id="quickBoxItem">
            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
            <p id="quickBoxName">Aaron Williams </p>
            <p id="quickBoxLocationStart">+<?php echo $driverSeat->getOriginLocation() ?></p>
            <p id="quickBoxLocationFinish">+<?php echo $driverSeat->getDestinationLocation() ?></p>
            <p id="quickBoxConfirmButton">Confirm</p>
            <p id="quickBoxDeclineButton">Decline</p>
            <hr>
            <p id="quickBoxViewRequestButton">view request</p>
            <hr>
        </div>
    <?php endforeach; ?>
    <h3>Requests</h3>
    <?php foreach ($passengerSeats as $passengerSeat): ?>
        <div id="quickBoxItem">
            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getPictureUrlSmall(); ?>"></img>
            <p id="quickBoxName">Aaron Williams </p>
            <p id="quickBoxLocationStart">+<?php echo $passengerSeat->getOriginLocation() ?></p>
            <p id="quickBoxLocationFinish">+<?php echo $passengerSeat->getDestinationLocation() ?></p>
            <p id="quickBoxConfirmButton"><a href="" >Confirm</a></p>
            <p id="quickBoxDeclineButton"><a href="" >Decline</a></p>
            <hr>
            <a id="quickBoxViewRequestButton" href="<?php echo url_for('ride_show', array('ride_type'=>'offer','ride_id'=>$passengerSeat->getPassengerId())) ?>">
                view request
            </a>
            <hr>
        </div>
    <?php endforeach; ?>
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