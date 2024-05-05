<?php
    include $_SERVER['DOCUMENT_ROOT']. "/include/interface/operation.php";
    class Reservation{
        public $reservationID;
        public $customerID;
        public $roomID;
        public $makeDate;
        public $checkinDate;
        public $checkoutDate;
        public $status;
        public $price;

        public function __construct($attributes) {
            $this -> reservationID = $attributes[0];
            $this -> customerID = $attributes[1];
            $this -> roomID = $attributes[2];
            $this -> makeDate = $attributes[3];
            $this -> checkinDate = $attributes[4];
            $this -> checkoutDate = $attributes[5];
            $this -> status = $attributes[6];
            $this -> price = $attributes[7];
        }
    }
    
    function create_Reservation($customerID_, $roomID_, $checkinDate_, 
        $checkoutDate_, $status_, $price_, &$EXIT_STATE) {
        return create_Class(Reservation::class, "Reservation", [
            [$customerID_, [PDO::PARAM_STR, 64]], 
            [$roomID_, [PDO::PARAM_STR, 64]], 
            [date("Y-m-d H:i:s", time()), NULL], 
            [$checkinDate_, NULL], 
            [$checkoutDate_, NULL], 
            [$status_, [PDO::PARAM_STR, 255]], 
            [$price_, PDO::PARAM_STR]], $EXIT_STATE);
    }
    
    function query_Reservation($args, &$EXIT_STATE) {
        return query_Class(Reservation::class, "Reservation", [
            ["reservationID", [PDO::PARAM_STR, 64]], 
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["roomID", [PDO::PARAM_STR, 64]], 
            ["makeDate", NULL], 
            ["checkinDate", NULL], 
            ["checkoutDate", NULL], 
            ["status", [PDO::PARAM_STR, 255]], 
            ["price", PDO::PARAM_STR]], $args, $EXIT_STATE);
    }

    function edit_Reservation(&$Reservation, $args, &$EXIT_STATE) {
        return edit_Class($Reservation, "Reservation", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["roomID", [PDO::PARAM_STR, 64]], 
            ["makeDate", NULL], 
            ["checkinDate", NULL], 
            ["checkoutDate", NULL], 
            ["status", [PDO::PARAM_STR, 255]], 
            ["price", PDO::PARAM_STR]], $args, $EXIT_STATE);
    }

    function delete_Reservation($args, &$EXIT_STATE) {
        return delete_Class("Reservation", [
            ["reservationID", [PDO::PARAM_STR, 64]], 
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["roomID", [PDO::PARAM_STR, 64]], 
            ["makeDate", NULL], 
            ["checkinDate", NULL], 
            ["checkoutDate", NULL], 
            ["status", [PDO::PARAM_STR, 255]], 
            ["price", PDO::PARAM_STR]], $args, $EXIT_STATE);
    }
?>