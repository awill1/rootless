<?php use_stylesheet('message.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Messages'))
?>

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
                    <?php echo date("F j\, Y",strtotime($message->getCreatedAt())) ?>
                </td>
                <td>
                    <a class="messageListAuthorLink" href="<?php echo url_for("profile_show_user", $author) ?>">
                        <img class="messageListAuthorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author->getPictureUrlTiny(); ?>" alt="<?php echo $author->getFullName() ?>" />
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
        <?php endforeach; ?>
      </tbody>
    </table>
</form>
<a href="<?php echo url_for('message/new') ?>">New</a>
