<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addcomments extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('comments', array(
             'comment_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => true,
              'autoincrement' => true,
              'length' => 4,
             ),
             'event_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => false,
              'notnull' => true,
              'autoincrement' => false,
              'length' => 4,
             ),
             'person_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => false,
              'notnull' => true,
              'autoincrement' => false,
              'length' => 4,
             ),
             'comment' => 
             array(
              'type' => 'string',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => false,
              'notnull' => true,
              'autoincrement' => false,
              'length' => NULL,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'comment_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('comments');
    }
}