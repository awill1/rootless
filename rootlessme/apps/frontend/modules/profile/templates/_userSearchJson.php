{
    "success": true,
    "results": {
        	"name" : <?php echo json_encode($profile->full_name); ?>,
        	"ratings" : {<?php 
        	    $length = count($ratings);
				$i = 1;
        	    foreach($ratings as $key => $rating) {
        	    	print json_encode($key) . " : " . json_encode($rating);
                    if ($i < $length) {
						echo ', ';
						$i++;
					}
				}
        	?>}
        }
}

