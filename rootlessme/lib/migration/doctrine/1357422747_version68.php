<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version68 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('routes', 'routes_origin_place_id_places_place_id', array(
             'name' => 'routes_origin_place_id_places_place_id',
             'local' => 'origin_place_id',
             'foreign' => 'place_id',
             'foreignTable' => 'places',
             ));
        $this->createForeignKey('routes', 'routes_destination_place_id_places_place_id', array(
             'name' => 'routes_destination_place_id_places_place_id',
             'local' => 'destination_place_id',
             'foreign' => 'place_id',
             'foreignTable' => 'places',
             ));
        $this->addIndex('routes', 'routes_origin_place_id', array(
             'fields' => 
             array(
              0 => 'origin_place_id',
             ),
             ));
        $this->addIndex('routes', 'routes_destination_place_id', array(
             'fields' => 
             array(
              0 => 'destination_place_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('routes', 'routes_origin_place_id_places_place_id');
        $this->dropForeignKey('routes', 'routes_destination_place_id_places_place_id');
        $this->removeIndex('routes', 'routes_origin_place_id', array(
             'fields' => 
             array(
              0 => 'origin_place_id',
             ),
             ));
        $this->removeIndex('routes', 'routes_destination_place_id', array(
             'fields' => 
             array(
              0 => 'destination_place_id',
             ),
             ));
    }
}