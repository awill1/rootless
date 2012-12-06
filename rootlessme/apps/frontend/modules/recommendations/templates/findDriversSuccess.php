<h2>Results</h2>
<div>
    <h3>Passenger Info</h3>
    <div>From: <?php echo $passenger->getRoutes()->getOriginAddress(); ?></div>
    <div>To: <?php echo $passenger->getRoutes()->getDestinationAddress(); ?></div>
    <div>Date: <?php echo $passenger->getStartDate(); ?></div>
    <div>Price: <?php echo $passenger->getAskingPrice(); ?></div>
</div>
<div>
    <h3>Recommended Drivers Info</h3>
    <div>Count: <?php echo $drivers->count(); ?></div>
    <?php foreach ($drivers as $key => $driver) : ?>
        <div>
            <h4>Driver <?php echo $key; ?></h4>
            <div>From: <?php echo $driver->getRoutes()->getOriginAddress(); ?></div>
            <div>To: <?php echo $driver->getRoutes()->getDestinationAddress(); ?></div>
            <div>Date: <?php echo $driver->getStartDate(); ?></div>
            <div>Price: <?php echo $driver->getAskingPrice(); ?></div>
            <div>Name: <?php echo $driver->getPeople()->getProfiles()->getFullName(); ?></div>
        </div>
    <?php endforeach; ?>
</div>