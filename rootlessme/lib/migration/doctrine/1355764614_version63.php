<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version63 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('carpools', 'start_date', 'date', '25', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             ));
        $this->changeColumn('locations', 'step_id', 'integer', '4', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             ));
    }

    public function down()
    {

    }
}