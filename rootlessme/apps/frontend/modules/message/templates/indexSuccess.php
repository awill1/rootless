<?php use_stylesheet('message.css') ?>

<h1>Messages</h1>
<form name='messages_list_form' action="messages.html">
    <script type="text/javascript">
        <!-- Begin
        // <input type=button name="CheckAll"   value="Check All" onClick="checkAll(document.myform.list)">
        // <input type=button name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.myform.list)">
        function checkAll(field)
        {
                for (i = 0; i < field.length; i++)
                        field[i].checked = true ;
        }

        function uncheckAll(field)
        {
                for (i = 0; i < field.length; i++)
                        field[i].checked = false ;
        }
        //  End -->
    </script>
    <table id="messageTable">
      <thead>
    <!--    <tr>
          <th>Message</th>
          <th>Conversation</th>
          <th>Author</th>
          <th>Body</th>
          <th>Created at</th>
          <th>Updated at</th>
        </tr>-->
        <tr>
            <th>
                <input type="checkbox" name="CheckAll" value="Check All" onClick="javascript: if (this.checked) checkAll(document.messages_list_form); else uncheckAll(document.messages_list_form);">
            </th>
            <th>Sent</th>
            <th>From</th>
            <th>Subject</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($messages as $i => $message):
            $author = $message->getPeople()->getProfiles()->getFirst();
            ?>
            <tr class="<?php echo fmod($i, 2) ? 'messageListAltRow' : 'messageListRow' ?>">
                <td><input id="entry_box_4" class="message_list_check_box" type='checkbox' name='messages_selected[]' value='5'></td>
                <td>
                    <div class="dateBlockLarge">
                        <div class="dateBlockMonth">
                            <?php echo date("M",strtotime($message->getCreatedAt())) ?>
                        </div>
                        <div class="dateBlockDate">
                            <?php echo date("j",strtotime($message->getCreatedAt())) ?>
                        </div>
                        <div class="dateBlockTime">
                            <?php echo date("g:i A",strtotime($message->getCreatedAt())) ?>
                        </div>
                    </div>
                </td>
                <td>
                    <a class="messageListAuthorLink" href="<?php echo url_for("profile_show_user", $author) ?>">
                        <img class="messageListAuthorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author->getPictureUrlSmall(); ?>" alt="<?php echo $author->getFullName() ?>" />
                        <?php echo $author->getFullName() ?>
                    </a>
                </td>
                <td>
                    <div>
                        <a class="messageListTitleLink" href="<?php echo url_for("messages_show", $message) ?>">
                            <?php echo $message->getSubject() ?>
                        </a>
                    </div>
                    <div>
                        <?php echo $message->getBodyPreview() ?>...
                    </div>
                </td>
            </tr>
    <!--    <tr>
          <td><a href="<?php echo url_for('message/show?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>"><?php echo $message->getMessageId() ?></a></td>
          <td><a href="<?php echo url_for('message/show?message_id='.$message->getMessageId().'&conversation_id='.$message->getConversationId()) ?>"><?php echo $message->getConversationId() ?></a></td>
          <td><?php echo $message->getAuthorId() ?></td>
          <td><?php echo $message->getBody() ?></td>
          <td><?php echo $message->getCreatedAt() ?></td>
          <td><?php echo $message->getUpdatedAt() ?></td>
        </tr>-->
        <?php endforeach; ?>
      </tbody>
    </table>
</form>
<a href="<?php echo url_for('message/new') ?>">New</a>
