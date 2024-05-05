<?php
    include "../interface/connect.php";
    class Customer{
        public $customerID;
        public $name;
        public $email;
        public $contact;

        public function __construct($customerID_, $name_, $email_, $contact_) {
            $this -> customerID = $customerID_;
            $this -> name = $name_;
            $this -> email = $email_;
            $this -> contact = $contact_;
        }
    }
    
    function create_Customer($name_, $email_, $contact_, &$EXIT_STATE) {
        global $connect;
        $newID = create_unique_id();
        $verify_newID = $connect -> 
            prepare("SELECT customerID FROM `Customer` WHERE customerID = ?");
        $verify_newID -> execute([$newID]);
        while($verify_newID -> rowCount() > 0){
            $newID = create_unique_id();
            $verify_newID -> execute([$newID]);
        }
        
        $create_newCustomer = $connect -> 
            prepare("INSERT INTO `Customer` VALUES(?, ?, ?, ?)");
        $create_newCustomer -> bindParam(1, $newID, PDO::PARAM_STR, 64);
        $create_newCustomer -> bindParam(2, $name_, PDO::PARAM_STR, 255);
        $create_newCustomer -> bindParam(3, $email_, PDO::PARAM_STR, 255);
        $create_newCustomer -> bindParam(4, $contact_, PDO::PARAM_STR, 255);
        if($create_newCustomer -> execute()){
            $EXIT_STATE = "Customer create is success!";
            return new Customer($newID, $name_, $email_, $contact_);
        }
        else {
            $EXIT_STATE = "Customer create is failed!";
            return NULL;
        }
    }
    
    function query_Customer($args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }

        if($args) {
            $validArgs = [["customerID", [PDO::PARAM_STR, 64]], 
                ["name", [PDO::PARAM_STR, 255]], ["email", [PDO::PARAM_STR, 255]], 
                ["contact", [PDO::PARAM_STR, 255]]];
            $queryCondition = "";
            $queryArgs = [];
            foreach($validArgs as $validArg) {
                if(isset($args[$validArg[0]])) {
                    if($queryCondition != "") $queryCondition .= " AND ";
                    $queryCondition .= $validArg[0]. " = ?";
                    array_push($queryArgs, [$args[$validArg[0]], $validArg[1]]);
                }
            }
            if($queryCondition == "") {
                $EXIT_STATE = "No valid args be passed!";
                return NULL;
            }

            global $connect;
            $query_Customer = $connect -> prepare(
                "SELECT * FROM `Customer` WHERE ". $queryCondition);
            foreach($queryArgs as $index => $queryArg) {
                if(is_array($queryArg[1])) $query_Customer -> bindParam(
                    $index, $queryArg[0], $queryArg[1][0], $queryArg[1][1]);
                else $query_Customer -> bindParam(
                    $index, $queryArg[0], $queryArg[1]);
            }
        }
        else {
            global $connect;
            $query_Customer = $connect -> prepare(
                "SELECT * FROM `Customer`");
        }
        if(!$query_Customer -> execute()) {
            $EXIT_STATE = "Customer query is failed!";
            return NULL;
        }
        if($query_Customer -> rowCount() > 0){
            $CustomerList = [];
            while($aCustomer = $query_Customer -> fetch(PDO::FETCH_ASSOC)) {
                array_push($CustomerList, new Customer(
                    $aCustomer["customerID"], $aCustomer["name"], 
                    $aCustomer["email"], $aCustomer["contact"]));
            }
            $EXIT_STATE = "Customer query is success!";
            return $CustomerList;
        }
        else {
            $EXIT_STATE = "No match Customer found!";
            return [];
        }
    }

    function edit_Customer(&$Customer, $args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }
        
        $validArgs = [["name", [PDO::PARAM_STR, 255]], 
            ["email", [PDO::PARAM_STR, 255]], ["contact", [PDO::PARAM_STR, 255]]];
        $editStatement = "";
        $editArgs = [];
        foreach($validArgs as $validArg) {
            if(isset($args[$validArg[0]])) {
                if($editStatement != "") $editStatement .= ", ";
                $editStatement .= $validArg[0]. " = ?";
                array_push($editArgs, [$args[$validArg[0]], $validArg[1], $validArg[0]]);
            }
        }
        if($editStatement == "") {
            $EXIT_STATE = "No valid args be passed!";
            return NULL;
        }

        global $connect;
        $edit_Customer = $connect -> prepare(
            "UPDATE `Customer` SET ". $editStatement. 
            "WHERE customerID = \"". $Customer -> customerID. "\"");
        foreach($editArgs as $index => $editArg) {
            if(is_array($editArg[1])) $edit_Customer -> bindParam(
                $index, $editArg[0], $editArg[1][0], $editArg[1][1]);
            else $edit_Customer -> bindParam(
                $index, $editArg[0], $editArg[1]);
        }
        if($edit_Customer -> execute()) {
            foreach($editArgs as $editArg) $Customer -> $editArg[2] = $editArg[0];
            $EXIT_STATE = "Customer edit is success!";
            return $Customer;
        }
        else {
            $EXIT_STATE = "Customer edit is failed!";
            return NULL;
        }
    }

    function delete_Customer($args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }

        if($args) {
            $validArgs = [["customerID", [PDO::PARAM_STR, 64]], 
                ["name", [PDO::PARAM_STR, 255]], ["email", [PDO::PARAM_STR, 255]], 
                ["contact", [PDO::PARAM_STR, 255]]];
            $deleteCondition = "";
            $deleteArgs = [];
            foreach($validArgs as $validArg) {
                if(isset($args[$validArg[0]])) {
                    if($deleteCondition != "") $deleteCondition .= " AND ";
                    $deleteCondition .= $validArg[0]. " = ?";
                    array_push($deleteArgs, [$args[$validArg[0]], $validArg[1]]);
                }
            }
            if($deleteCondition == "") {
                $EXIT_STATE = "No valid args be passed!";
                return NULL;
            }

            global $connect;
            $delete_Customer = $connect -> prepare(
                "DELETE FROM `Customer` WHERE ". $deleteCondition);
            foreach($deleteArgs as $index => $deleteArg) {
                if(is_array($deleteArg[1])) $delete_Customer -> bindParam(
                    $index, $deleteArg[0], $deleteArg[1][0], $deleteArg[1][1]);
                else $delete_Customer -> bindParam(
                    $index, $deleteArg[0], $deleteArg[1]);
            }
        }
        else {
            global $connect;
            $delete_Customer = $connect -> prepare(
                "DELETE FROM `Customer`");
        }
        if($delete_Customer -> execute()) {
            $EXIT_STATE = "Customer delete is success!";
            return NULL;
        }
        else {
            $EXIT_STATE = "Customer delete is failed!";
            return NULL;
        }
    }
?>