<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version43 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('seats_history', 'seats_history_changer_id_people_person_id', array(
             'name' => 'seats_history_changer_id_people_person_id',
             'local' => 'changer_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('seats_history', 'seats_history_seat_id_seats_seat_id', array(
             'name' => 'seats_history_seat_id_seats_seat_id',
             'local' => 'seat_id',
             'foreign' => 'seat_id',
             'foreignTable' => 'seats',
             ));
        $this->addIndex('seats_history', 'seats_history_changer_id', array(
             'fields' => 
             array(
              0 => 'changer_id',
             ),
             ));
        $this->addIndex('seats_history', 'seats_history_seat_id', array(
             'fields' => 
             array(
              0 => 'seat_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('seats_history', 'seats_history_changer_id_people_person_id');
        $this->dropForeignKey('seats_history', 'seats_history_seat_id_seats_seat_id');
        $this->removeIndex('seats_history', 'seats_history_changer_id', array(
             'fields' => 
             array(
              0 => 'changer_id',
             ),
             ));
        $this->removeIndex('seats_history', 'seats_history_seat_id', array(
             'fields' => 
             array(
              0 => 'seat_id',
             ),
             ));
    }
}