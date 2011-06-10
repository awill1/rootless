<li class="headerControlsListItem">
    <a href="<?php echo url_for('messages') ?>" class="headerControl">
        Inbox
        <?php if($newMessages->count() > 0): ?>
            (<?php echo $newMessages->count() ?>)
        <?php endif; ?>
        <img src="/images/messageSmall.JPG" alt="1 message" />
    </a>
     <?php foreach ($newMessages as $newMessage): ?>
     <ul class="headerControlsListSublist">
        <li class="headerControlsListSublistItem">
            <a class="headerSublistControl" href="<?php echo url_for('messages_show',$newMessage) ?>">
                <?php echo $newMessage->getSubject() ?>
            </a>
        </li>
    </ul>
    <?php endforeach; ?>
</li>