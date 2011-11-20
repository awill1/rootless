<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version47 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('seats_history', 'seats_history_solo_route_id_routes_route_id', array(
             'name' => 'seats_history_solo_route_id_routes_route_id',
             'local' => 'solo_route_id',
             'foreign' => 'route_id',
             'foreignTable' => 'routes',
             ));
        $this->addIndex('seats_history', 'seats_history_solo_route_id', array(
             'fields' => 
             array(
              0 => 'solo_route_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('seats_history', 'seats_history_solo_route_id_routes_route_id');
        $this->removeIndex('seats_history', 'seats_history_solo_route_id', array(
             'fields' => 
             array(
              0 => 'solo_route_id',
             ),
             ));
    }
}