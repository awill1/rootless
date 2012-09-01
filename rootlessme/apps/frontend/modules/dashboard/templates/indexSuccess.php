<?php use_stylesheet(sfConfig::get('app_css_dashboard')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Dashboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/<?php echo sfConfig::get('app_jquery_block_ui_script') ?>"></script>
    <script type="text/javascript" src="/js/dashboard.js"></script>
<?php end_slot();?>

<h1>Dashboard</h1>

<div id="rootlessPromoVideo">
    <iframe src="http://player.vimeo.com/video/43364584?color=40b355" width="520" height="292" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>

<div id="rideSection">
    <div id="rideInformationDashLeft">
        <h3>Offers Posted</h3>
        <?php if ($carpools->count() == 0) : ?>
            <p>No upcoming ride offers</p>
        <?php endif; ?>
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
                            <div class="deleteRideCont" >
                                <a class="quickBoxDeleteRideButton" title="Delete" href="<?php echo url_for('ride_delete', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>">
                                    X
                                </a>
                            </div>
                            <div class="originCont">+<?php echo $route->getOriginString() ?></div>
                            <div class="destinationCont">+<?php echo $route->getDestinationString() ?></div>
                            <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'offer', 'ride_id' => $carpool->getCarpoolId())) ?>" >View Ride</a>
                        </div>
                    </div>
                    <ul class="seatsList">
                        <?php foreach ($driverSeats as $driverSeat): ?>
                            <?php if ($driverSeat->getCarpoolId() == $carpool->getCarpoolId()) : ?>
                                <?php $passenger = $driverSeat->getPassengers()->getPeople()->getProfiles();
                                      $seatRoute = $driverSeat->getRoutes(); ?>
                                <li class="seatsListItem">
                                    <?php include_component('dashboard', 'seatListItem', array('seat' => $driverSeat, 'show' => 'passenger')); ?>
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
        <?php if ($passengers->count() == 0) : ?>
            <p>No upcoming ride requests</p>
        <?php endif; ?>
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
                            <div class="deleteRideCont" >
                                <a class="quickBoxDeleteRideButton" title="Delete" href="<?php echo url_for('ride_delete', array('ride_type' => 'request', 'ride_id' => $passenger->getPassengerId())) ?>">
                                    X
                                </a>
                            </div>
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
                                    <?php include_component('dashboard', 'seatListItem', array('seat' => $passengerSeat, 'show' => 'driver')); ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
</div>

