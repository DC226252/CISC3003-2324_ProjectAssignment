<?php
    include $_SERVER['DOCUMENT_ROOT']. "/include/interface/operation.php";
    class Customer{
        public $customerID;
        public $name;
        public $email;
        public $contact;

        public function __construct($attributes) {
            $this -> customerID = $attributes[0];
            $this -> name = $attributes[1];
            $this -> email = $attributes[2];
            $this -> contact = $attributes[3];
        }
    }
    
    function create_Customer($name_, $email_, $contact_, &$EXIT_STATE) {
        return create_Class(Customer::class, "Customer", [
            [$name_, [PDO::PARAM_STR, 255]], 
            [$email_, [PDO::PARAM_STR, 255]], 
            [$contact_, [PDO::PARAM_STR, 255]]], $EXIT_STATE);
    }
    
    function query_Customer($args, &$EXIT_STATE) {
        return query_Class(Customer::class, "Customer", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function edit_Customer(&$Customer, $args, &$EXIT_STATE) {
        return edit_Class($Customer, "Customer", [
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }

    function delete_Customer($args, &$EXIT_STATE) {
        return delete_Class("Customer", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], 
            ["contact", [PDO::PARAM_STR, 255]]], $args, $EXIT_STATE);
    }
?>