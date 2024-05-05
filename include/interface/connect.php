<?php
    $_ENV = parse_ini_file("../../.env");
    $connect = new PDO($_ENV["DB_NAME"], 
        $_ENV["DB_USER_NAME"], $_ENV["DB_USER_PASS"]);
    
    function create_unique_id() {
        $charecters = 
            "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWSYZ";
        $random = "";
        for($i = 0; $i < 64; $i++)
            $random .= $charecters[mt_rand(0, strlen($charecters) - 1)];
        return $random;
    }
?>