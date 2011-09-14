<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addfks extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('carpools', 'carpools_route_id_routes_route_id', array(
             'name' => 'carpools_route_id_routes_route_id',
             'local' => 'route_id',
             'foreign' => 'route_id',
             'foreignTable' => 'routes',
             ));
        $this->createForeignKey('carpools', 'carpools_vehicle_id_vehicles_vehicle_id', array(
             'name' => 'carpools_vehicle_id_vehicles_vehicle_id',
             'local' => 'vehicle_id',
             'foreign' => 'vehicle_id',
             'foreignTable' => 'vehicles',
             ));
        $this->createForeignKey('carpools', 'carpools_solo_route_id_routes_route_id', array(
             'name' => 'carpools_solo_route_id_routes_route_id',
             'local' => 'solo_route_id',
             'foreign' => 'route_id',
             'foreignTable' => 'routes',
             ));
        $this->createForeignKey('carpools', 'carpools_driver_id_people_person_id', array(
             'name' => 'carpools_driver_id_people_person_id',
             'local' => 'driver_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('comments', 'comments_event_id_events_event_id', array(
             'name' => 'comments_event_id_events_event_id',
             'local' => 'event_id',
             'foreign' => 'event_id',
             'foreignTable' => 'events',
             ));
        $this->createForeignKey('comments', 'comments_person_id_people_person_id', array(
             'name' => 'comments_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('conversation_participants', 'cccc', array(
             'name' => 'cccc',
             'local' => 'conversation_id',
             'foreign' => 'conversation_id',
             'foreignTable' => 'conversations',
             ));
        $this->createForeignKey('conversation_participants', 'conversation_participants_person_id_people_person_id', array(
             'name' => 'conversation_participants_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('conversations', 'conversations_author_id_people_person_id', array(
             'name' => 'conversations_author_id_people_person_id',
             'local' => 'author_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('events', 'events_location_id_locations_location_id', array(
             'name' => 'events_location_id_locations_location_id',
             'local' => 'location_id',
             'foreign' => 'location_id',
             'foreignTable' => 'locations',
             ));
        $this->createForeignKey('friendship_requests', 'friendship_requests_requestor_id_people_person_id', array(
             'name' => 'friendship_requests_requestor_id_people_person_id',
             'local' => 'requestor_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('friendship_requests', 'friendship_requests_requestee_id_people_person_id', array(
             'name' => 'friendship_requests_requestee_id_people_person_id',
             'local' => 'requestee_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('friendship_requests', 'ffff', array(
             'name' => 'ffff',
             'local' => 'friendship_status_id',
             'foreign' => 'friendship_status_id',
             'foreignTable' => 'friendship_statuses',
             ));
        $this->createForeignKey('friendships', 'friendships_friend1_id_people_person_id', array(
             'name' => 'friendships_friend1_id_people_person_id',
             'local' => 'friend1_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('friendships', 'friendships_friend2_id_people_person_id', array(
             'name' => 'friendships_friend2_id_people_person_id',
             'local' => 'friend2_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('legs', 'legs_route_id_routes_route_id', array(
             'name' => 'legs_route_id_routes_route_id',
             'local' => 'route_id',
             'foreign' => 'route_id',
             'foreignTable' => 'routes',
             ));
        $this->createForeignKey('locations', 'locations_step_id_steps_step_id', array(
             'name' => 'locations_step_id_steps_step_id',
             'local' => 'step_id',
             'foreign' => 'step_id',
             'foreignTable' => 'steps',
             ));
        $this->createForeignKey('message_recipients', 'message_recipients_message_id_messages_message_id', array(
             'name' => 'message_recipients_message_id_messages_message_id',
             'local' => 'message_id',
             'foreign' => 'message_id',
             'foreignTable' => 'messages',
             ));
        $this->createForeignKey('message_recipients', 'message_recipients_person_id_people_person_id', array(
             'name' => 'message_recipients_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('messages', 'messages_conversation_id_conversations_conversation_id', array(
             'name' => 'messages_conversation_id_conversations_conversation_id',
             'local' => 'conversation_id',
             'foreign' => 'conversation_id',
             'foreignTable' => 'conversations',
             ));
        $this->createForeignKey('messages', 'messages_author_id_people_person_id', array(
             'name' => 'messages_author_id_people_person_id',
             'local' => 'author_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('passengers', 'passengers_person_id_people_person_id', array(
             'name' => 'passengers_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('passengers', 'passengers_solo_route_id_routes_route_id', array(
             'name' => 'passengers_solo_route_id_routes_route_id',
             'local' => 'solo_route_id',
             'foreign' => 'route_id',
             'foreignTable' => 'routes',
             ));
        $this->createForeignKey('profiles', 'profiles_person_id_people_person_id', array(
             'name' => 'profiles_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('reviews', 'reviews_reviewer_id_people_person_id', array(
             'name' => 'reviews_reviewer_id_people_person_id',
             'local' => 'reviewer_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('reviews', 'reviews_reviewee_id_people_person_id', array(
             'name' => 'reviews_reviewee_id_people_person_id',
             'local' => 'reviewee_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('reviews', 'reviews_seat_id_seats_seat_id', array(
             'name' => 'reviews_seat_id_seats_seat_id',
             'local' => 'seat_id',
             'foreign' => 'seat_id',
             'foreignTable' => 'seats',
             ));
        $this->createForeignKey('seats', 'seats_carpool_id_carpools_carpool_id', array(
             'name' => 'seats_carpool_id_carpools_carpool_id',
             'local' => 'carpool_id',
             'foreign' => 'carpool_id',
             'foreignTable' => 'carpools',
             ));
        $this->createForeignKey('seats', 'seats_seat_status_id_seat_statuses_seat_status_id', array(
             'name' => 'seats_seat_status_id_seat_statuses_seat_status_id',
             'local' => 'seat_status_id',
             'foreign' => 'seat_status_id',
             'foreignTable' => 'seat_statuses',
             ));
        $this->createForeignKey('seats', 'ssss_1', array(
             'name' => 'ssss_1',
             'local' => 'seat_request_type_id',
             'foreign' => 'seat_request_type_id',
             'foreignTable' => 'seat_request_types',
             ));
        $this->createForeignKey('seats', 'seats_passenger_id_passengers_passenger_id', array(
             'name' => 'seats_passenger_id_passengers_passenger_id',
             'local' => 'passenger_id',
             'foreign' => 'passenger_id',
             'foreignTable' => 'passengers',
             ));
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
        $this->createForeignKey('security_settings', 'security_settings_person_id_people_person_id', array(
             'name' => 'security_settings_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('steps', 'steps_leg_id_legs_leg_id', array(
             'name' => 'steps_leg_id_legs_leg_id',
             'local' => 'leg_id',
             'foreign' => 'leg_id',
             'foreignTable' => 'legs',
             ));
        $this->createForeignKey('travelers_attending_event', 'travelers_attending_event_event_id_events_event_id', array(
             'name' => 'travelers_attending_event_event_id_events_event_id',
             'local' => 'event_id',
             'foreign' => 'event_id',
             'foreignTable' => 'events',
             ));
        $this->createForeignKey('travelers_attending_event', 'tsaa', array(
             'name' => 'tsaa',
             'local' => 'status',
             'foreign' => 'attending_status_type_id',
             'foreignTable' => 'attending_status_type',
             ));
        $this->createForeignKey('travelers_attending_event', 'travelers_attending_event_person_id_people_person_id', array(
             'name' => 'travelers_attending_event_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('users', 'users_person_id_people_person_id', array(
             'name' => 'users_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('vehicles', 'vehicles_person_id_people_person_id', array(
             'name' => 'vehicles_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('sf_guard_forgot_password', 'sf_guard_forgot_password_user_id_sf_guard_user_id', array(
             'name' => 'sf_guard_forgot_password_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_group_permission', 'sf_guard_group_permission_group_id_sf_guard_group_id', array(
             'name' => 'sf_guard_group_permission_group_id_sf_guard_group_id',
             'local' => 'group_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_group',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_group_permission', 'sf_guard_group_permission_permission_id_sf_guard_permission_id', array(
             'name' => 'sf_guard_group_permission_permission_id_sf_guard_permission_id',
             'local' => 'permission_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_permission',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_remember_key', 'sf_guard_remember_key_user_id_sf_guard_user_id', array(
             'name' => 'sf_guard_remember_key_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_user', 'sf_guard_user_person_id_people_person_id', array(
             'name' => 'sf_guard_user_person_id_people_person_id',
             'local' => 'person_id',
             'foreign' => 'person_id',
             'foreignTable' => 'people',
             ));
        $this->createForeignKey('sf_guard_user_group', 'sf_guard_user_group_user_id_sf_guard_user_id', array(
             'name' => 'sf_guard_user_group_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_user_group', 'sf_guard_user_group_group_id_sf_guard_group_id', array(
             'name' => 'sf_guard_user_group_group_id_sf_guard_group_id',
             'local' => 'group_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_group',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_user_permission', 'sf_guard_user_permission_user_id_sf_guard_user_id', array(
             'name' => 'sf_guard_user_permission_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('sf_guard_user_permission', 'sf_guard_user_permission_permission_id_sf_guard_permission_id', array(
             'name' => 'sf_guard_user_permission_permission_id_sf_guard_permission_id',
             'local' => 'permission_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_permission',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
    }

    public function down()
    {
        $this->dropForeignKey('carpools', 'carpools_route_id_routes_route_id');
        $this->dropForeignKey('carpools', 'carpools_vehicle_id_vehicles_vehicle_id');
        $this->dropForeignKey('carpools', 'carpools_solo_route_id_routes_route_id');
        $this->dropForeignKey('carpools', 'carpools_driver_id_people_person_id');
        $this->dropForeignKey('comments', 'comments_event_id_events_event_id');
        $this->dropForeignKey('comments', 'comments_person_id_people_person_id');
        $this->dropForeignKey('conversation_participants', 'cccc');
        $this->dropForeignKey('conversation_participants', 'conversation_participants_person_id_people_person_id');
        $this->dropForeignKey('conversations', 'conversations_author_id_people_person_id');
        $this->dropForeignKey('events', 'events_location_id_locations_location_id');
        $this->dropForeignKey('friendship_requests', 'friendship_requests_requestor_id_people_person_id');
        $this->dropForeignKey('friendship_requests', 'friendship_requests_requestee_id_people_person_id');
        $this->dropForeignKey('friendship_requests', 'ffff');
        $this->dropForeignKey('friendships', 'friendships_friend1_id_people_person_id');
        $this->dropForeignKey('friendships', 'friendships_friend2_id_people_person_id');
        $this->dropForeignKey('legs', 'legs_route_id_routes_route_id');
        $this->dropForeignKey('locations', 'locations_step_id_steps_step_id');
        $this->dropForeignKey('message_recipients', 'message_recipients_message_id_messages_message_id');
        $this->dropForeignKey('message_recipients', 'message_recipients_person_id_people_person_id');
        $this->dropForeignKey('messages', 'messages_conversation_id_conversations_conversation_id');
        $this->dropForeignKey('messages', 'messages_author_id_people_person_id');
        $this->dropForeignKey('passengers', 'passengers_person_id_people_person_id');
        $this->dropForeignKey('passengers', 'passengers_solo_route_id_routes_route_id');
        $this->dropForeignKey('profiles', 'profiles_person_id_people_person_id');
        $this->dropForeignKey('reviews', 'reviews_reviewer_id_people_person_id');
        $this->dropForeignKey('reviews', 'reviews_reviewee_id_people_person_id');
        $this->dropForeignKey('reviews', 'reviews_seat_id_seats_seat_id');
        $this->dropForeignKey('seats', 'seats_carpool_id_carpools_carpool_id');
        $this->dropForeignKey('seats', 'seats_seat_status_id_seat_statuses_seat_status_id');
        $this->dropForeignKey('seats', 'ssss_1');
        $this->dropForeignKey('seats', 'seats_passenger_id_passengers_passenger_id');
        $this->dropForeignKey('seats_filled_legs', 'seats_filled_legs_seat_id_seats_seat_id');
        $this->dropForeignKey('seats_filled_legs', 'seats_filled_legs_leg_id_legs_leg_id');
        $this->dropForeignKey('security_settings', 'security_settings_person_id_people_person_id');
        $this->dropForeignKey('steps', 'steps_leg_id_legs_leg_id');
        $this->dropForeignKey('travelers_attending_event', 'travelers_attending_event_event_id_events_event_id');
        $this->dropForeignKey('travelers_attending_event', 'tsaa');
        $this->dropForeignKey('travelers_attending_event', 'travelers_attending_event_person_id_people_person_id');
        $this->dropForeignKey('users', 'users_person_id_people_person_id');
        $this->dropForeignKey('vehicles', 'vehicles_person_id_people_person_id');
        $this->dropForeignKey('sf_guard_forgot_password', 'sf_guard_forgot_password_user_id_sf_guard_user_id');
        $this->dropForeignKey('sf_guard_group_permission', 'sf_guard_group_permission_group_id_sf_guard_group_id');
        $this->dropForeignKey('sf_guard_group_permission', 'sf_guard_group_permission_permission_id_sf_guard_permission_id');
        $this->dropForeignKey('sf_guard_remember_key', 'sf_guard_remember_key_user_id_sf_guard_user_id');
        $this->dropForeignKey('sf_guard_user', 'sf_guard_user_person_id_people_person_id');
        $this->dropForeignKey('sf_guard_user_group', 'sf_guard_user_group_user_id_sf_guard_user_id');
        $this->dropForeignKey('sf_guard_user_group', 'sf_guard_user_group_group_id_sf_guard_group_id');
        $this->dropForeignKey('sf_guard_user_permission', 'sf_guard_user_permission_user_id_sf_guard_user_id');
        $this->dropForeignKey('sf_guard_user_permission', 'sf_guard_user_permission_permission_id_sf_guard_permission_id');
    }
}