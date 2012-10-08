<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version57 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('notification_settings', array(
             'notification_setting_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'notification_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'person_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'wants_email' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '1',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'notification_setting_id',
             ),
             ));
        $this->createTable('notifications', array(
             'notification_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'display_text' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '255',
             ),
             'slug' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '45',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'notification_id',
             ),
             ));
    }
    
    public function postUp()
    {
        // Add in the customer notifications
        $seatRequestedNotification = new Notifications();
        $seatRequestedNotification->display_text = 'Someone requests a ride from me';
        $seatRequestedNotification->slug = 'SEAT_REQUESTED_NOTIFICATION';
        $seatRequestedNotification->save();
        $seatOfferedNotification = new Notifications();
        $seatOfferedNotification->display_text = 'Someone offers me a ride';
        $seatOfferedNotification->slug = 'SEAT_OFFERED_NOTIFICATION';
        $seatOfferedNotification->save();
        $seatNegotiatedNotification = new Notifications();
        $seatNegotiatedNotification->display_text = 'Someone changes the terms of a ride with me';
        $seatNegotiatedNotification->slug = 'SEAT_NEGOTIATED_NOTIFICATION';
        $seatNegotiatedNotification->save();
        $seatAcceptedNotification = new Notifications();
        $seatAcceptedNotification->display_text = 'Someone accepts the terms of a ride with me';
        $seatAcceptedNotification->slug = 'SEAT_ACCEPTED_NOTIFICATION';
        $seatAcceptedNotification->save();
        $seatDeclinedNotification = new Notifications();
        $seatDeclinedNotification->display_text = 'Someone declines the terms of a ride with me';
        $seatDeclinedNotification->slug = 'SEAT_DECLINED_NOTIFICATION';
        $seatDeclinedNotification->save();
        
        // Get a list of the created notifications
        $notifications = Doctrine_Query::create()
                ->select('n.notification_id')
                ->from('Notifications n')
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
    }

    public function down()
    {
        $this->dropTable('notification_settings');
        $this->dropTable('notifications');
    }
}