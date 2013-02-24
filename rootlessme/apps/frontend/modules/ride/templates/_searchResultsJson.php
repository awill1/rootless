{
    "success": true,
    "start_date": "<?php echo $startDate->format('Y-m-d'); ?>",
    "end_date": "<?php echo $endDate->format('Y-m-d'); ?>",
    "results": [
        <?php $ridesArray = $sf_data->getRaw('rides'); 
              foreach ($ridesArray as $date => $ridesOnDay) : ?>
        {
            "date" : "<?php echo $date; ?>",
            "rides" : [
                <?php foreach ($ridesOnDay as $rideIndex => $ride) :
                      $rideType = $ride->getRideType();
                      $isDriver = ($rideType == 'offer');
                      $isPassenger = ($rideType == 'request');?>
                {
                    "id": <?php echo $ride->getRideId(); ?>,
                    "is_driver": <?php echo var_export($isDriver); ?>,
                    "is_passenger": <?php echo var_export($isPassenger); ?>,
                    "start_date": <?php echo json_encode($ride->getStartDate()); ?>,
                    "start_time": <?php echo json_encode($ride->getStartTime());?>,
                    "asking_price": <?php echo json_encode($ride->getAskingPrice(), JSON_NUMERIC_CHECK); ?>,
                    "seat_count": <?php echo json_encode($ride->getSeatCount(), JSON_NUMERIC_CHECK); ?>, 
                    "person" : {
                        <?php $personProfile = $ride->getPeople()->getProfiles(); ?>
                        "id": "<?php echo $personProfile->getProfileName(); ?>",
                        "first_name": <?php echo json_encode($personProfile->getFirstName()); ?>,
                        "last_name": <?php echo json_encode($personProfile->getLastName()); ?>,
                        "picture_small_url": "<?php echo sfConfig::get('app_profile_picture_directory'); ?><?php echo $personProfile->getPictureUrlSmall(); ?>"
                    },
                    "route": {
                        <?php $route = $ride->getRoutes(); ?>
                        "origin_string" : <?php echo json_encode($route->getOriginString()); ?>,
                        "destination_string" : <?php echo json_encode($route->getDestinationString()); ?>,
                        "encoded_polyline": <?php echo json_encode($route->getEncodedPolyline()); ?>
                    }
                }
                    <?php if ($rideIndex < count($ridesOnDay)-1) 
                        {   
                            echo ',';
                        }
                    ?>
                <?php endforeach; ?>
            ]
        }
            <?php $maxDate = max(array_keys($ridesArray)); ?>
            <?php if ($date != $maxDate) 
                {   
                    echo ',';
                }
            ?>
        <?php endforeach; ?>
    ] 
}

