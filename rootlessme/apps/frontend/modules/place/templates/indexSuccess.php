<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<div id="indexMain">
    <h1>Share rides to your favorite places</h1>
    <ul class="placesList">
        <?php foreach ($places as $place): ?>
            <?php if ($place->getSlug()!=null): ?>
                <a href="<?php echo url_for('place_show_slug', array('place_id'=>$place->getPlaceId(), 'slug'=>$place->getSlug()))?>" class="featureLink">
            <?php else: ?>
                <a href="<?php echo url_for('place_show', array('place_id'=>$place->getPlaceId())) ?>">
            <?php endif; ?>
            <li>
                <div class="placeBox">
                    <div class="placeImg">
                        <img src="<?php echo $place->getIndexImageUrl(); ?>" width="261"/>
                    </div>
                    <div class="placeInfo">
                        <div class='placeName'><?php echo $place->getName() ?></div>
                        <div class='placeLocation'><?php echo $place->getLocation()->getCityStateString(); ?></div>
                    </div>
                    <div class='placeTags'><?php echo $place->getTags() ?></div>
                </div>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
</div>