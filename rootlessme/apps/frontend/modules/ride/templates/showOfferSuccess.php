<?php use_stylesheet('ride.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - %s to %s', $origin->getCityStateString(), $destination->getCityStateString()))
?>

<div id="mainRideSummary">
    <div id="mainRideDate" class="dateBlockLarge">
        <div class="dateBlockMonth">
            <?php echo date("M",strtotime($carpool->getStartDate())) ?>
        </div>
        <div class="dateBlockDate">
            <?php echo date("j",strtotime($carpool->getStartDate())) ?>
        </div>
        <div class="dateBlockTime">
            <?php echo date("g:i A",strtotime($carpool->getStartTime())) ?>
        </div>
    </div>
    <h1 id="mainEventTitle">
        <a class="locationLink" href="#">
            +<?php echo $origin->getCityStateString() ?>
        </a>
        to
        <a class="locationLink" href="#">
            +<?php echo $destination->getCityStateString() ?>
        </a>
    </h1>
    <p>going to <a href="#">Sun Country at Bogarts</a></p>
    <?php echo $carpool->getSeatsAvailable() ?>
    <?php echo ($carpool->getSeatsAvailable() == 1 ? "seat" : "seats") ?>
    available
    Ride Offer
    <!-- TODO: Add smoking -->
    Smoking: Yes
    One Way Trip
    <a id="mainEventSubtitle" href="www.coachella.com">www.coachella.com</a>
    <ul>
        <li><a href="#">Request a Ride</a></li>
    </ul>
</div>

<!--<?php echo $carpoolRoute->getEncodedPolyline() ?>-->

<img id="rideMapImage" src="http://maps.google.com/maps/api/staticmap?size=453x305&path=weight:5|color:0x119F49|enc:<?php echo $carpoolRoute->getEncodedPolyline() ?>&sensor=false" alt="Interactive Map" />
<!--<img id="rideMapImage" src="http://maps.google.com/maps/api/staticmap?size=453x305&path=weight:3%7Ccolor:orange%7Cenc:_fisIp~u%7CU}%7Ca@pytA_~b@hhCyhS~hResU%7C%7Cx@oig@rwg@amUfbjA}f[roaAynd@%7CvXxiAt{ZwdUfbjAewYrqGchH~vXkqnAria@c_o@inc@k{g@i%60]o%7CF}vXaj\h%60]ovs@?yi_@rcAgtO%7Cj_AyaJren@nzQrst@zuYh%60]v%7CGbldEuzd@%7C%7Cx@spD%7CtrAzwP%7Cd_@yiB~vXmlWhdPez\_{Km_%60@~re@ew^rcAeu_@zhyByjPrst@ttGren@aeNhoFemKrvdAuvVidPwbVr~j@or@f_z@ftHr{ZlwBrvdAmtHrmT{rOt{Zz}E%7Cc%7C@o%7CLpn~AgfRpxqBfoVz_iAocAhrVjr@rh~@jzKhjp@%60%60NrfQpcHrb^k%7CDh_z@nwB%7Ckb@a{R%7Cyh@uyZ%7CllByuZpzw@wbd@rh~@%7C%7CFhqs@teTztrAupHhyY}t]huf@e%7CFria@o}GfezAkdW%7C}[ocMt_Neq@ren@e~Ika@pgE%7Ci%7CAfiQ%7C%60l@uoJrvdAgq@fppAsjGhg%60@%7ChQpg{Ai_V%7C%7Cx@mkHhyYsdP%7CxeA~gF%7C}[mv%60@t_NitSfjp@c}Mhg%60@sbChyYq}e@rwg@atFff}@ghN~zKybk@fl}A}cPftcAite@tmT__Lha@u~DrfQi}MhkSqyWivIumCria@ciO_tHifm@fl}A{rc@fbjAqvg@rrqAcjCf%7Ci@mqJtb^s%7C@fbjA{wDfs%60BmvEfqs@umWt_Nwn^pen@qiBr%60xAcvMr{Zidg@dtjDkbM%7Cd_@&sensor=false" alt="Interactive Map" />-->
<!--<img id="rideMapImage" src="columbusMap.JPG" alt="Interactive Map" />-->

<div id="mainRidePeople">
    <a href="<?php echo url_for("profile_show_user", $driver)  ?>">
        <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $driver->getPictureUrlLarge() ?>" alt="<?php echo $driver->getFullName() ?>" />
    </a>
    <h3>Riding</h3>
    <ul>
        <li><a href="profile.html"><img src="russ_profile_small.JPG" alt="DJ" />DJ</a></li>
        <li><a href="profile.html"><img src="russ_profile_small.JPG" alt="Zach" />Zach</a></li>
        <li><a href="profile.html"><img src="russ_profile_small.JPG" alt="Peter" />Peter</a></li>
    </ul>
</div>
<div id="mainRideDetails">
    <h3>Posted By: <a href="<?php echo url_for("profile_show_user", $driver)  ?>"><?php echo $driver->getFullName() ?></a></h3>
    <h3>Trip Value: $50</h3>
    <h3>Asking Price: $<?php echo $carpool->getAskingPrice() ?> per person</h3>
    <p id="mainRideInformation"><?php echo $carpool->getDescription() ?>
    </p>
</div>