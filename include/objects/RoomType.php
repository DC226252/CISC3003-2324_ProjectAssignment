<?php
    include realpath("./include/interface/operation.php");
    class RoomType{
        public $type;

        public $format;
        public $price;
        public $size;
        public $capacity;
        public $bed;
        public $services;

        public function __construct($attributes) {
            $this -> type = $attributes[0];
            $this -> format = $attributes[1];
            $this -> price = $attributes[2];
            $this -> size = $attributes[3];
            $this -> capacity = $attributes[4];
            $this -> bed = $attributes[5];
            $this -> services = $attributes[6];
        }
    }
    
    function query_RoomType($args, &$EXIT_STATE) {
        return query_Class(RoomType::class, "RoomType", [ 
            ["type", PDO::PARAM_INT],  
            ["format", [PDO::PARAM_STR, 255]], 
            ["price", PDO::PARAM_STR, 255], 
            ["size", PDO::PARAM_INT], 
            ["capacity", PDO::PARAM_INT], 
            ["bed", [PDO::PARAM_STR, 255]], 
            ["services", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }
?>