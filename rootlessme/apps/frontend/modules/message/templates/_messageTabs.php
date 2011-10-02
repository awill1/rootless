<h1>Welcome to your inbox, <?php echo $sf_user->getGuardUser()->getPeople()->getProfiles()->getFirst()->getFirstName(); ?>!</h1>

<div id="middleMessageDetails">
    <ul>
        <li class="selectedNav"><a href="<?php echo url_for('messages_list', array('list_type'=>'inbox')) ?>" title="Inbox">Inbox</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'sent')) ?>" title="Sent">Sent</a></li>
        <li class=""><a href="<?php echo url_for('messages_list', array('list_type'=>'trash')) ?>" title="Trash">Trash</a></li>
        <li class=""><a href="<?php echo url_for('messages_new') ?>" class="messageButton" title="new_message">+ Compose</a></li>
    </ul>
</div>