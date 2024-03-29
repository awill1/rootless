<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addfriendships extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('friendships', array(
             'friend1_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => true,
              'autoincrement' => false,
              'length' => 4,
             ),
             'friend2_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => true,
              'autoincrement' => false,
              'length' => 4,
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
              0 => 'friend1_id',
              1 => 'friend2_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('friendships');
    }
}