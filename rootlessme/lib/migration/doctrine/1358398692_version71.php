<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version71 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeColumn('places', 'address_string');
    }

    public function down()
    {
        $this->addColumn('places', 'address_string', 'string', '255', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             ));
    }
}