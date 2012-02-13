<?php use_stylesheet('dashboard.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Dashboard'))
?>

<h1>Dashboard</h1>

<div id="rideSection">
    <ul>
        <div id="rideInformationDashLeft">
            <h3>Offers Posted</h3>
            <?php foreach ($carpools as $carpool):
                      $route = $carpool->getRoutes(); ?>
                <li>
                    <div class="rideCont">
                        <div class="dateCont">
                            <div class="monthCont"><?php echo date("M",strtotime($carpool->getStartDate())) ?></div>
                            <div class="dayCont"><?php echo date("j",strtotime($carpool->getStartDate())) ?></div>
                            <div class="timeCont"><?php echo date("g:i A",strtotime($carpool->getStartTime())) ?></div>
                        </div>
                        <div class="locationCont">
                            +<?php echo $route->getOriginString() ?><br />
                            +<?php echo $route->getDestinationString() ?><br />
                            <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>" >View Ride</a>
                        </div>
                    </div>
                </li>
                <?php foreach ($driverSeats as $driverSeat): ?>
                    <?php if ($driverSeat->getCarpoolId() == $carpool->getCarpoolId()) : ?>
                        <?php $passenger = $driverSeat->getPassengers()->getPeople()->getProfiles();
                              $seatRoute = $driverSeat->getRoutes(); ?>
                        <li>
                            <div id="quickBoxItem">
                                <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPictureUrlSmall(); ?>" />
                                <p id="quickBoxName"><?php echo $passenger->getFullName() ?></p>
                                <p id="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
                                <p id="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
                                <p id="quickBoxConfirmButton">Confirm</p>
                                <p id="quickBoxDeclineButton">Decline</p>

                                <a id="quickBoxViewRequestButton">view negotiation</a>
                            </div>
                        </li>
                   <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>     
        </div>
    </ul>
    <ul>
        <div id="rideInformationDashRight">
            <div class="negotiationAndPostInfoContRight">
                <h3>Requests Posted</h3>
                <?php foreach ($passengers as $passenger):
                      $route = $passenger->getRoutes(); ?>
                    <li>
                        <div class="rideCont"> 
                            <div class="dateCont">
                                <div class="monthCont"><?php echo date("M",strtotime($passenger->getStartDate())) ?></div>
                                <div class="dayCont"><?php echo date("j",strtotime($passenger->getStartDate())) ?></div>
                                <div class="timeCont"><?php echo date("g:i A",strtotime($passenger->getStartTime())) ?></div>
                            </div>
                            <div class="locationCont">
                                +<?php echo $route->getOriginString() ?><br />
                                +<?php echo $route->getDestinationString() ?><br />
                                <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'request', 'ride_id' => $passenger->getPassengerId())) ?>" >View Ride</a>
                            </div>
                        </div>
                    </li>
                    <?php foreach ($passengerSeats as $passengerSeat): ?>
                        <?php if ($passengerSeat->getPassengerId() == $passenger->getPassengerId()): ?>
                            <?php $driver = $passengerSeat->getCarpools()->getPeople()->getProfiles();
                                  $seatRoute = $passengerSeat->getRoutes(); ?>
                            <li>
                                <div id="quickBoxItem">
                                    <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlSmall(); ?>" />
                                    <p id="quickBoxName"><?php echo $driver->getFullName() ?></p>
                                    <p id="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
                                    <p id="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
                                    <p id="quickBoxConfirmButton"><a href="" >Confirm</a></p>
                                    <p id="quickBoxDeclineButton"><a href="" >Decline</a></p>

                                    <a id="quickBoxViewRequestButton" href="<?php echo url_for('ride_show', array('ride_type'=>'offer','ride_id'=>$passengerSeat->getCarpoolId())) ?>">
                                        view negotiation
                                    </a>

                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?> 
                <?php endforeach; ?>
            </div> 
        </div>
    </ul>
</div>

<div id="quickRidesBox">
    <h3>Confirmed Rides</h3>
</div>
