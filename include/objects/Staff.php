<?php
    include realpath("./include/interface/operation.php");
    class Staff{
        public $staffID;
        public $name;
        public $position;
        public $email;
        public $contact;

        public function __construct($attributes) {
            $this -> staffID = $attributes[0];
            $this -> name = $attributes[1];
            $this -> position = $attributes[2];
            $this -> email = $attributes[3];
            $this -> contact = $attributes[4];
        }
    }
    
    function create_Staff($name_, $position_, $email_, $contact_, &$EXIT_STATE) {
        return create_Class(Staff::class, "Staff", [
            [$name_, [PDO::PARAM_STR, 255]], 
            [$position_, [PDO::PARAM_STR, 255]], 
            [$email_, [PDO::PARAM_STR, 255]], 
            [$contact_, [PDO::PARAM_STR, 255]]], $EXIT_STATE);
    }
    
    function query_Staff($args, &$EXIT_STATE) {
        return query_Class(Staff::class, "Staff", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["position", [PDO::PARAM_STR, 255]], 
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function edit_Staff(&$Staff, $args, &$EXIT_STATE) {
        return edit_Class($Staff, "Staff", [
            ["position", [PDO::PARAM_STR, 255]], 
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function delete_Staff($args, &$EXIT_STATE) {
        return delete_Class("Staff", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["position", [PDO::PARAM_STR, 255]], 
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }
?>