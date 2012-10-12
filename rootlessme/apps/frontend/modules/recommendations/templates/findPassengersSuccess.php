<h2>Results</h2>
<div>
    <h3>Driver Info</h3>
    <div>From: <?php echo $driver->getRoutes()->getOriginAddress(); ?></div>
    <div>To: <?php echo $driver->getRoutes()->getDestinationAddress(); ?></div>
    <div>Date: <?php echo $driver->getStartDate(); ?></div>
    <div>Price: <?php echo $driver->getAskingPrice(); ?></div>
    <div>Number of intermediate points: <?php echo $driver->getRoutes()->getLocationsInRoute()->count(); ?>
</div>
<div>
    <h3>Recommended Passengers Info</h3>
    <div>Count: <?php echo $passengers->count(); ?></div>
    <?php  foreach ($passengers as $key => $passenger): ?>
        <div>
            <h4>Passenger <?php echo $key; ?></h4>
            <div>From: <?php echo $passenger->getRoutes()->getOriginAddress(); ?></div>
            <div>To: <?php echo $passenger->getRoutes()->getDestinationAddress(); ?></div>
            <div>Date: <?php echo $passenger->getStartDate(); ?></div>
            <div>Price: <?php echo $passenger->getAskingPrice(); ?></div>
            <div>Name: <?php echo $passenger->getPeople()->getProfiles()->getFullName(); ?></div>
        </div>
    <?php endforeach; ?>
</div>

