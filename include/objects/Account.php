<?php 
    include $_SERVER['DOCUMENT_ROOT']. "/include/interface/operation.php";
    class Account{
        public $accountID;
        public $customerID;
        public $username;
        public $password;
        public $privilege;

        public function __construct($attributes) {
            $this -> accountID = $attributes[0];
            $this -> customerID = $attributes[1];
            $this -> username = $attributes[2];
            $this -> password = $attributes[3];
            $this -> privilege = $attributes[4];
        }
    }
    
    function create_Account($customerID_, $username_, 
        $password_, $privilege_, &$EXIT_STATE) {
        return create_Class(Account::class, "Account", [
            [$customerID_, [PDO::PARAM_STR, 64]], 
            [$username_, [PDO::PARAM_STR, 255]], 
            [$password_, [PDO::PARAM_STR, 64]], 
            [$privilege_, PDO::PARAM_INT]], $EXIT_STATE);
    }
    
    function query_Account($args, &$EXIT_STATE) {
        return query_Class(Account::class, "Account", [
            ["accountID", [PDO::PARAM_STR, 64]],
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["username", [PDO::PARAM_STR, 255]], 
            ["password", [PDO::PARAM_STR, 64]], 
            ["privilege", PDO::PARAM_INT]], $args, $EXIT_STATE);
    }

    function edit_Account(&$Account, $args, &$EXIT_STATE) {
        return edit_Class($Account, "Account", [
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["username", [PDO::PARAM_STR, 255]], 
            ["password", [PDO::PARAM_STR, 64]], 
            ["privilege", PDO::PARAM_INT]], $args, $EXIT_STATE);
    }

    function delete_Account($args, &$EXIT_STATE) {
        return delete_Class("Account", [
            ["accountID", [PDO::PARAM_STR, 64]],
            ["customerID", [PDO::PARAM_STR, 64]], 
            ["username", [PDO::PARAM_STR, 255]], 
            ["password", [PDO::PARAM_STR, 64]], 
            ["privilege", PDO::PARAM_INT]], $args, $EXIT_STATE);
    }
?>