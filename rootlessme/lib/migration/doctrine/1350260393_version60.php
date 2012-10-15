<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version60 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('seats', 'is_hidden_for_driver', 'boolean', '25', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             'default' => '0',
             ));
        $this->addColumn('seats', 'is_hidden_for_passenger', 'boolean', '25', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             'default' => '0',
             ));
    }
    
    public function postUp()
    {
        // There is a new notification for recommending seats
        $seatRecommendedSlug = 'SEAT_RECOMMENDED_NOTIFICATION';
        $seatRecommendedNotification = new Notifications();
        $seatRecommendedNotification->display_text = 'Rootless recommends a traveler to me';
        $seatRecommendedNotification->slug = $seatRecommendedSlug;
        $seatRecommendedNotification->default_wants_email = 1;
        $seatRecommendedNotification->save();
        
        // Get a list of the created notifications
        $notifications = Doctrine_Query::create()
                ->select('n.notification_id')
                ->from('Notifications n')
                ->where('n.slug = ?', array($seatRecommendedSlug))
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
        
        // Add a new seat status for the recommended seats
        $recommendedSeatStatus = new SeatStatuses();
        $recommendedSeatStatus->seat_status_id = 4;
        $recommendedSeatStatus->display_text = 'Recommended';
        $recommendedSeatStatus->slug = 'recommended';
        $recommendedSeatStatus->save();
    }

    public function down()
    {
        $this->removeColumn('seats', 'is_hidden_for_driver');
        $this->removeColumn('seats', 'is_hidden_for_passenger');
    }
}