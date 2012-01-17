<?php use_stylesheet('dashboard.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Dashboard'))
?>

<h1>Dashboard</h1>

<div id="rideSection">
    
    <div id="rideInformationDashLeft">
        <h3>Offers Posted</h3>
        
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
                <?php foreach ($driverSeats as $driverSeat): 
          $passenger = $driverSeat->getPassengers()->getPeople()->getProfiles(); ?>
            
        <div id="quickBoxItem">
            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $passenger->getPictureUrlSmall(); ?>" />
            <p id="quickBoxName"><?php echo $passenger->getFullName() ?></p>
            <p id="quickBoxLocationStart">+<?php echo $driverSeat->getOriginLocation() ?></p>
            <p id="quickBoxLocationFinish">+<?php echo $driverSeat->getDestinationLocation() ?></p>
            <p id="quickBoxConfirmButton">Confirm</p>
            <p id="quickBoxDeclineButton">Decline</p>
            <hr>
            <p id="quickBoxViewRequestButton">view negotiation</p>
            <hr>
        </div>
            
        <?php endforeach; ?>  
            </div>       
        <?php endforeach; ?>
               
    </div>
    <ul>
    <div id="rideInformationDashRight">
        <div class="negotiationAndPostInfoCont">
        <h3>Requests Posted</h3>
        
        <?php foreach ($passengers as $passenger): ?>
        <li>
            <div class="rideCont"> 
                <div class="dateCont">
                    <div class="monthCont"><?php echo date("M",strtotime($passenger->getStartDate())) ?></div>
                    <div class="dayCont"><?php echo date("j",strtotime($passenger->getStartDate())) ?></div>
                    <div class="timeCont"><?php echo date("g:i A",strtotime($passenger->getStartTime())) ?></div>
                </div>
                
                
                <div class="locationCont">
                +<?php echo $passenger->getOriginLocation() ?><br /> 
                +<?php echo $passenger->getDestinationLocation() ?><br /> 
                <a class="viewRideLink" href="<?php echo url_for('ride_show', array('ride_type' => 'request', 'ride_id' => $passenger->getPassengerId())) ?>" >View Ride</a>
                </div>
                </div>
            </li>
                <?php foreach ($passengerSeats as $passengerSeat): 
          $driver = $passengerSeat->getCarpools()->getPeople()->getProfiles(); ?>
                
                <li>
        <div id="quickBoxItem">
            <img id="leftProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlSmall(); ?>" />
            <p id="quickBoxName"><?php echo $driver->getFullName() ?></p>
            <p id="quickBoxLocationStart">+<?php echo $passengerSeat->getOriginLocation() ?></p>
            <p id="quickBoxLocationFinish">+<?php echo $passengerSeat->getDestinationLocation() ?></p>
            <p id="quickBoxConfirmButton"><a href="" >Confirm</a></p>
            <p id="quickBoxDeclineButton"><a href="" >Decline</a></p>
            
            <a id="quickBoxViewRequestButton" href="<?php echo url_for('ride_show', array('ride_type'=>'offer','ride_id'=>$passengerSeat->getCarpoolId())) ?>">
                view negotiation
            </a>
            
        </div>
                </li>
                
        
        <?php endforeach; ?> 
                </div> 
        <?php endforeach; ?>
        
    </div>
    </ul>
</div>


<div id="quickRidesBox">
    <h3>Confirmed Rides</h3>
    
    
</div>
