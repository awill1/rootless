<?php use_stylesheet('message.css') ?>
<?php slot(
  'title',
  sprintf('Rootless Me - Sent Messages'))
?>

        <form name='messages_list_<?php echo $listType ?>_form' action="messages.html">
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
            
            
            
            <table class="messageTable" >
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="CheckAll" value="Check All" onClick="javascript: if (this.checked) checkAll(document.messages_list_<?php echo $listType ?>_form); else uncheckAll(document.messages_list_<?php echo $listType ?>_form);">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $i => $message):
                        //$author = $message->getPeople()->getProfiles()->getFirst();
                        $author = $message['People']['Profiles'][0];
                        ?>
                        <tr class="<?php echo fmod($i, 2) ? 'tableAltRow' : 'tableRow' ?>
                                   <?php if (count($message['MessageRecipients']) > 0 && $message['MessageRecipients'][0]['unread'] ) echo 'messageUnread' ?>">
                            <td><input id="entry_box_4" class="message_list_check_box" type='checkbox' name='messages_selected[]' value='5'></td>
                            <td>
                                <?php echo date("F j\, Y",strtotime($message['created_at'])) ?>
                            </td>
                            <td>
                                    <img class="messageListAuthorProfileImage" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $author['picture_url_tiny']; ?>" alt="<?php echo $author['first_name'].' '.$author['last_name'] ?>" />
                                    <?php echo $author['first_name'].' '.$author['last_name'] ?>
                            </td>
                            <td>
                                <a class="tableLink" href="<?php echo url_for("messages_show", array('message_id' => $message['message_id'])) ?>">
                                <div>
                                        <?php echo $message['subject'] ?>
                                </div>
                                <div>
                                    <?php echo substr($message['body'],0,40) ?>...
                                </div>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>