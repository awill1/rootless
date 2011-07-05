<?php use_stylesheet('message.css') ?>

<?php slot(
  'title',
  sprintf('Rootless Me - Messages'))
?>

<?php slot('gmapheader'); ?>
    
    <script type="text/javascript">
        // Function when the page is ready
        $(document).ready(function(){
            // Make the entire message row clickable
            $("tbody tr")
                //.click(function(){
                //    // Navigate to the first link's reference
                //    DoNav($(this).find("a").attr("href"));
                //    //DoNav("http://www.rootless.me.localhost/frontend_dev.php/messages/22");
                //})
                // Change the hover style
                .hover(
                    function()
                    {
                        HighlightRow($(this))
                    }
                    ,function()
                    {
                        UnHighlightRow($(this))
                    }
                )
                .find('td:not(:has(:checkbox, a))')
                    .click(function (e) {
                        DoNav("http://www.yahoo.com");
                        //window.location = $('td.msg p a').attr('href');
                });
	});
        
        function HighlightRow(tableRow)
        {
            tableRow.addClass("messageListSelectedRow");
        }
        function UnHighlightRow(tableRow)
        {
            tableRow.removeClass("messageListSelectedRow");
        }
        
        function DoNav(theUrl)
        {
            document.location.href = theUrl;
        }
    </script>
<?php end_slot();?>


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
            <tr class="<?php echo fmod($i, 2) ? 'messageListAltRow' : 'messageListRow' ?> <?php //if ($message->getMessageRecipients()->getFirst()->getUnread()) echo 'messageUnread' ?>">
                <td><input id="entry_box_4" class="message_list_check_box" type='checkbox' name='messages_selected[]' value='5'></td>
                <td>
                    <?php echo date("F j\, Y",strtotime($message->getCreatedAt())) ?>
                </td>
                <td>
                        <img class="messageListAuthorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author->getPictureUrlTiny(); ?>" alt="<?php echo $author->getFullName() ?>" />
                        <?php echo $author->getFullName() ?>
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
