<li class="headerControlsListItem">
    <a href="<?php echo url_for('messages') ?>" class="headerControl">
        Inbox
        <?php if($newMessages->count() > 0): ?>
            (<?php echo $newMessages->count() ?>)
        <?php endif; ?>
        <img src="/images/mailbox.png" alt="Messages" />
    </a>
     <ul class="headerControlsListSublist inboxView">
     <?php foreach ($newMessages as $newMessage): ?>
        <li class="headerControlsListSublistItem">
            <a class="headerSublistControl" href="<?php echo url_for('messages_show',$newMessage) ?>">
                <span class="quickViewImage">
                    <?php $profile = $newMessage->getPeople()->getProfiles(); ?>
                    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $profile->getPictureUrlSmall(); ?>" alt="<?php echo $profile->getFullName(); ?>" />
                </span>
                <span class="quickViewInfo">
                    <h2>
                        <?php echo $profile->getFullName(); ?>
                    </h2>
                    <h3>
                        <?php echo $newMessage->getSubject(); ?>
                    </h3>
                    <p>
                    <?php echo substr($newMessage->getBody(),0,40);
                        if(strlen($newMessage->getBody()) > 40) {
                            echo "...";
                        }
                    ?>
                    </p>
                </span>
            </a>
        </li>
    <?php endforeach; ?>
        <li class="headerControlsListSublistItem inLink"><a href="<?php echo url_for('messages'); ?>" title="Go To Inbox" >Go To Inbox</a></li>
    </ul>
</li>