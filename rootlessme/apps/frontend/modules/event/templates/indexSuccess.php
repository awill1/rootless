<?php use_stylesheet(sfConfig::get('app_css_event')) ?>
<?php use_helper('Date'); ?>
<div id="indexMain">
    <h1>Share rides to the best events</h1>
    <ul class="eventsList">
        <?php foreach ($events as $event): ?>
            <?php if ($event->getSlug()!=null): ?>
                <a href="<?php echo url_for('event_show_slug', array('event_id'=>$event->getEventId(), 'slug'=>$event->getSlug()))?>" class="featureLink">
            <?php else: ?>
                <a href="<?php echo url_for('event_show', array('event_id'=>$event->getEventId())) ?>">
            <?php endif; ?>
            <li>
                <div class="eventBox">
                    <div class="eventImg">
                        <img src="<?php echo $event->getIndexImageUrl(); ?>" width="261"/>
                    </div>
                    <div class="eventInfo">
                        <div class='eventName'><?php echo $event->getName() ?></div>
                        <div class='eventLocation'><span class="strongSpan"><?php echo format_date($event->getStartDate(), 'MMMM dd');?> – <?php echo format_date($event->getEndDate(), 'MMMM dd');?> | </span><span class="italicSpan"><?php echo $event->getPlaces()->getLocation(); ?></span></div>
                    </div>
                    <div class='eventTags'><?php echo $event->getTags() ?></div>
                </div>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
    <div id="suggestBox"><a href="mailto:contact@rootless.me?Subject=Hi%20I%20have%20a%20new%20event">Want to share rides to an event that's not here? Let us know and we'll add it!</a></div>
</div>