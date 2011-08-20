<li class="headerControlsListItem">
    <a href="<?php echo url_for('messages') ?>" class="headerControl">
        Inbox
        <?php if($newMessages->count() > 0): ?>
            (<?php echo $newMessages->count() ?>)
        <?php endif; ?>
        <img src="/images/mailbox.png" alt="Messages" />
    </a>
     <ul class="headerControlsListSublist">
     <?php foreach ($newMessages as $newMessage): ?>
        <li class="headerControlsListSublistItem">
            <a class="headerSublistControl" href="<?php echo url_for('messages_show',$newMessage) ?>">
                <?php 
                    $profile = $newMessage->getPeople()->getProfiles()->getFirst();
                    echo "<img src='/uploads/assets/profile_pictures/";
                    echo $profile->getPictureUrlSmall();
                    echo "' />";
                    echo $profile->getFullName();
                    echo $newMessage->getSubject();
                    echo $newMessage->getBody();
                ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</li>