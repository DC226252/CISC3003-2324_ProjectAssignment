<?php
    include $_SERVER['DOCUMENT_ROOT']. "/include/interface/operation.php";
    class Room{
        public $roomID;
        public $roomNum;
        public $type; //should be meaning one people or two people
        public $status;

        public function __construct($attributes) {
            $this -> roomID = $attributes[0];
            $this -> roomNum = $attributes[1];
            $this -> type = $attributes[2];
            $this -> status = $attributes[3];
        }
    }
    
    function create_Room($roomNum_, $type_, $status_, &$EXIT_STATE) {
        return create_Class(Room::class, "Room", [
            [$roomNum_, [PDO::PARAM_STR, 255]], 
            [$type_, PDO::PARAM_INT], 
            [$status_, [PDO::PARAM_STR, 255]]], $EXIT_STATE);
    }
    
    function query_Room($args, &$EXIT_STATE) {
        return query_Class(Room::class, "Room", [
            ["roomID", [PDO::PARAM_STR, 64]],
            ["roomNum", [PDO::PARAM_STR, 255]], 
            ["type", PDO::PARAM_INT], 
            ["status", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function edit_Room(&$Room, $args, &$EXIT_STATE) {
        return edit_Class($Room, "Room", [
            ["roomNum", [PDO::PARAM_STR, 255]], 
            ["type", PDO::PARAM_INT], 
            ["status", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function delete_Room($args, &$EXIT_STATE) {
        return delete_Class("Room", [
            ["roomID", [PDO::PARAM_STR, 64]],
            ["roomNum", [PDO::PARAM_STR, 255]], 
            ["type", PDO::PARAM_INT], 
            ["status", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }
?>