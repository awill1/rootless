<?php use_stylesheet('dashboard.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Dashboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="/js/dashboard.js"></script>
<?php end_slot();?>

<h1>Dashboard</h1>

<div id="rideSection">
    <div id="rideInformationDashLeft">
        <h3>Offers Posted</h3>
        <ul class="ridesList">
            <?php foreach ($carpools as $carpool):
                      $route = $carpool->getRoutes(); ?>
                <li class="ridesListItem">
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
                    <ul class="seatsList">
                        <?php foreach ($driverSeats as $driverSeat): ?>
                            <?php if ($driverSeat->getCarpoolId() == $carpool->getCarpoolId()) : ?>
                                <?php $passenger = $driverSeat->getPassengers()->getPeople()->getProfiles();
                                      $seatRoute = $driverSeat->getRoutes(); ?>
                                <li class="seatsListItem">
                                    <div class="quickBoxItem">
                                        <img class="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPictureUrlSmall(); ?>" />
                                        <p class="quickBoxName"><?php echo $passenger->getFullName() ?></p>
                                        <p class="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
                                        <p class="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
                                        <p class="quickBoxStatus">Status: <?php echo ucfirst(Doctrine_Core::getTable('SeatStatuses')->getStatusString($driverSeat->getSeatStatusId())) ?></p>
                                        <ul class="quickBoxButtonsList">
                                            <li class="quickBoxButtonsListItem">
                                                <a class="quickBoxAcceptButton" href="<?php echo url_for('seats_accept') ?>">
                                                    <div class="hidden seatIdContainer" ><?php echo $driverSeat->getSeatId() ?></div>
                                                    Accept
                                                </a>
                                            </li>
                                            <li class="quickBoxButtonsListItem">
                                                <a class="quickBoxDeclineButton" href="<?php echo url_for('seats_decline') ?>">
                                                    <div class="hidden seatIdContainer" ><?php echo $driverSeat->getSeatId() ?></div>
                                                    Decline
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="quickBoxRequest">
                                            <a class="quickBoxViewRequestButton" href="/rides">view negotiation</a>
                                        </div>
                                    </div>
                                </li>
                           <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?> 
        </ul>    
    </div>
    <div id="rideInformationDashRight">
        <h3>Requests Posted</h3> 
        <ul class="ridesList">
            <?php foreach ($passengers as $passenger):
                  $route = $passenger->getRoutes(); ?>
                <li class="ridesListItem">
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
                    <ul class="seatsList">
                        <?php foreach ($passengerSeats as $passengerSeat): ?>
                            <?php if ($passengerSeat->getPassengerId() == $passenger->getPassengerId()): ?>
                                <?php $driver = $passengerSeat->getCarpools()->getPeople()->getProfiles();
                                      $seatRoute = $passengerSeat->getRoutes(); ?>
                                <li class="seatsListItem">
                                    <div class="quickBoxItem">
                                        <img class="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlSmall(); ?>" />
                                        <p class="quickBoxName"><?php echo $driver->getFullName() ?></p>
                                        <p class="quickBoxLocationStart">+<?php echo $seatRoute->getOriginString() ?></p>
                                        <p class="quickBoxLocationFinish">+<?php echo $seatRoute->getDestinationString() ?></p>
                                        <p class="quickBoxStatus">Status: <?php echo ucfirst(Doctrine_Core::getTable('SeatStatuses')->getStatusString($passengerSeat->getSeatStatusId())) ?></p>
                                        <ul class="quickBoxButtonsList">
                                            <li class="quickBoxButtonsListItem">
                                                <a class="quickBoxAcceptButton" href="<?php echo url_for('seats_accept') ?>">
                                                    <div class="hidden seatIdContainer" ><?php echo $passengerSeat->getSeatId() ?></div>
                                                    Accept
                                                </a>
                                            </li>
                                            <li class="quickBoxButtonsListItem">
                                                <a class="quickBoxDeclineButton" href="<?php echo url_for('seats_decline') ?>">
                                                    <div class="hidden seatIdContainer" ><?php echo $passengerSeat->getSeatId() ?></div>
                                                    Decline
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="quickBoxRequest">
                                            <a class="quickBoxViewRequestButton" href="/rides">view negotiation</a>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
