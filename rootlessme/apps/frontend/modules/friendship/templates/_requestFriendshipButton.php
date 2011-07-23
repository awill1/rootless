<?php use_helper('PartialPlus') ?>
<?php append_to_slot('gmapheader'); ?>

<script type="text/javascript" src="/js/jquery.form.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        // Show or hide the review form as needed
        $('#addFriendButton').button().click(function(){
            // Submit a friend request
            return false;
        });
    });
</script>
<?php end_slot();?>


<div>
<?php if ($showAddFriend): ?>
    <input id="addFriendButton" type="button" value="Add as friend" />
<?php elseif ($showRequestResponse): ?>
    <input id="requestResponseButton" type="button" value="Respond to request" />
<?php elseif ($showPendingText): ?>
    Friend Request Pending
<?php endif ?>
</div>
