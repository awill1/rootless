<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version51 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropTable('attending_status_type');
        $this->dropTable('comments');
        $this->dropTable('events');
        $this->dropTable('friendship_requests');
        $this->dropTable('friendship_statuses');
        $this->dropTable('friendships');
        $this->dropTable('security_settings');
        $this->dropTable('travelers_attending_event');
        $this->dropTable('users');
    }

    public function down()
    {
        $this->createTable('attending_status_type', array(
             'attending_status_type_id' => 
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
              'notnull' => '',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'attending_status_type_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('comments', array(
             'comment_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'event_id' => 
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
             'comment' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'comment_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('events', array(
             'event_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'location_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'name' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '45',
             ),
             'date' => 
             array(
              'type' => 'date',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '25',
             ),
             'time' => 
             array(
              'type' => 'time',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '25',
             ),
             'picture_url_large' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '255',
             ),
             'picture_url_small' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '255',
             ),
             'description' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '1024',
             ),
             'website_url' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '255',
             ),
             'certification' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'event_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('friendship_requests', array(
             'requestor_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'requestee_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'friendship_status_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'abuse' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '1',
             ),
             'abuse_comment' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'requestor_id',
              1 => 'requestee_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('friendship_statuses', array(
             'friendship_status_id' => 
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
              'notnull' => '',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'friendship_status_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('friendships', array(
             'friend1_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'friend2_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '4',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'friend1_id',
              1 => 'friend2_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('security_settings', array(
             'security_settings_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
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
             'can_email_promotions' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'length' => '1',
             ),
             'can_email_partners' => 
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'security_settings_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('travelers_attending_event', array(
             'event_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'person_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '4',
             ),
             'status' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '4',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'event_id',
              1 => 'person_id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->createTable('users', array(
             'user_name' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '1',
              'autoincrement' => '',
              'length' => '45',
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
             'email' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '45',
             ),
             'encrypted_password' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'length' => '128',
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
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'user_name',
             ),
             'collate' => '',
             'charset' => '',
             ));
    }
}