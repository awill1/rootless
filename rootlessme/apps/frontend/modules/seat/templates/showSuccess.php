<!-- <link href="/css/ride.css" rel="stylesheet" type="text/css"> -->
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>
<?php include_component('seat', 'showSeat', array('seat' => $seat)) ?>
<?php include_component('seat', 'negotiation', array('seat' => $seat)) ?>