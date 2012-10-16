<h1>Welcome to your inbox, <?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirstName(); ?>!</h1>

<div id="middleMessageDetails">
    <ul>
        <li class="selectedNav"><a href="<?php echo url_for('messages_list', array('list_type'=>'inbox')) ?>" title="Inbox">Inbox</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'sent')) ?>" title="Sent">Sent</a></li>
        <li class=""><a href="<?php echo url_for('messages_new') ?>" class="messageButton" title="new_message">+ Send New Message</a></li>
    </ul>
</div>