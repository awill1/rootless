<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version59 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('notifications', 'default_wants_email', 'integer', '1', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             ));
    }
    
    public function postUp()
    {
        // There is a new notification for receiving messages
        $newMessageSlug = 'NEW_MESSAGE_NOTIFICATION';
        $newMessageNotification = new Notifications();
        $newMessageNotification->display_text = 'Someone sends me a message';
        $newMessageNotification->slug = $newMessageSlug;
        $newMessageNotification->save();
        
        // Get a list of the created notifications
        $notifications = Doctrine_Query::create()
                ->select('n.notification_id')
                ->from('Notifications n')
                ->where('n.slug = ?', array($newMessageSlug))
                ->execute();
        
        // Get a list of all people
        $people = Doctrine_Query::create()->select('p.person_id')
                ->from('People p')
                ->execute();
        
        // Create the new notification settings for all people
        foreach($people as $person)
        {
            foreach($notifications as $notification)
            {
                // Create the notification setting
                $notificationSetting = new NotificationSettings();
                $notificationSetting->person_id = $person->getPersonId();
                $notificationSetting->notification_id = $notification->getNotificationId();
                $notificationSetting->wants_email = 1;
                $notificationSetting->save();                
            }
        }
        
        // Set the default email notification fields to 1
        $q = Doctrine_Query::create()->update('notifications')
                                     ->set('default_wants_email', '?', 1);
        $q->execute();
    }

    public function down()
    {
        $this->removeColumn('notifications', 'default_wants_email');
    }
}