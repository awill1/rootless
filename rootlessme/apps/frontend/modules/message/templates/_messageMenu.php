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
                    echo "<span class='quickViewImage'>";
                    echo "<img src='/uploads/assets/profile_pictures/";
                    echo $profile->getPictureUrlSmall();
                    echo "' />";
                    echo "</span>";
                    echo "<span class='quickViewInfo'>";
                    echo "<h2>";
                    echo $profile->getFullName();
                    echo "</h2>";
                    echo "<h3>";
                    echo $newMessage->getSubject();
                    echo "</h3>";
                    echo "<p>";
                    echo substr($newMessage->getBody(),0,40);
                    
                    if(strlen($newMessage->getBody()) > 40) {
                    echo "...";
                    
                    }
                    echo "</p>";
                    echo "</span>";
                ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</li>