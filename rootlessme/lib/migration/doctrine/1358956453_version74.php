<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version74 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('places', 'slug', 'string', '128', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             'unique' => '1',
             ));
    }

    public function down()
    {
        $this->removeColumn('places', 'slug');
    }
}