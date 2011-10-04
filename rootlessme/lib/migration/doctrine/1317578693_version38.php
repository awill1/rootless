<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version38 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('seats_filled_legs', 'seats_filled_legs_seat_id_seats_seat_id');
        $this->dropForeignKey('seats_filled_legs', 'seats_filled_legs_leg_id_legs_leg_id');
    }

    public function down()
    {
        $this->createForeignKey('seats_filled_legs', 'seats_filled_legs_seat_id_seats_seat_id', array(
             'name' => 'seats_filled_legs_seat_id_seats_seat_id',
             'local' => 'seat_id',
             'foreign' => 'seat_id',
             'foreignTable' => 'seats',
             ));
        $this->createForeignKey('seats_filled_legs', 'seats_filled_legs_leg_id_legs_leg_id', array(
             'name' => 'seats_filled_legs_leg_id_legs_leg_id',
             'local' => 'leg_id',
             'foreign' => 'leg_id',
             'foreignTable' => 'legs',
             ));
    }
}