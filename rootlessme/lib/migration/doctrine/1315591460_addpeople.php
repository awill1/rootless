<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addpeople extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('people', array(
             'person_id' => 
             array(
              'type' => 'integer',
              'fixed' => 0,
              'unsigned' => false,
              'primary' => true,
              'autoincrement' => true,
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
              0 => 'person_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('people');
    }
}