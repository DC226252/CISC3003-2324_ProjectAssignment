<?php
    $_ENV = parse_ini_file(realpath("./.env"));
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

    function create_Class($ClassType, $ClassName, $args, &$EXIT_STATE) {
        global $connect;
        $newID = create_unique_id();
        $verify_newID = $connect -> 
            prepare("SELECT ". strtolower($ClassName). "ID FROM `". 
                $ClassName. "` WHERE ". strtolower($ClassName). "ID = ?");
        $verify_newID -> execute([$newID]);
        while($verify_newID -> rowCount() > 0){
            $newID = create_unique_id();
            $verify_newID -> execute([$newID]);
        }
        
        $create_newClass = $connect -> 
            prepare("INSERT INTO `". $ClassName. "` VALUES(".
                substr(str_repeat("?, ", count($args) + 1), 0, -2). ")");
        $create_newClass -> bindParam(1, $newID, PDO::PARAM_STR, 64);
        $newClassAttr = [$newID];
        foreach($args as $index => $arg) {
            if($arg[1] != NULL) {
                if(is_array($arg[1]))
                    $create_newClass -> bindParam(
                        $index + 2, $arg[0], $arg[1][0], $arg[1][1]);
                else
                    $create_newClass -> bindParam(
                        $index + 2, $arg[0], $arg[1]); 
            }
            else $create_newClass -> bindParam($index + 2, $arg[0]); 
            array_push($newClassAttr, $arg[0]); 
        }
        if($create_newClass -> execute()){
            $EXIT_STATE = $ClassName. " create is success!";
            return new $ClassType($newClassAttr);
        }
        else {
            $EXIT_STATE = $ClassName. " create is failed!";
            return NULL;
        }
    }

    function query_Class($ClassType, $ClassName, $validArgs, $args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }

        if($args) {
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
            $query_Class = $connect -> prepare(
                "SELECT * FROM `". $ClassName. "` WHERE ". $queryCondition);
            foreach($queryArgs as $index => $queryArg) {
                if($queryArg[1] != NULL) {
                    if(is_array($queryArg[1])) $query_Class -> bindParam(
                        $index + 1, $queryArg[0], $queryArg[1][0], $queryArg[1][1]);
                    else $query_Class -> bindParam(
                        $index + 1, $queryArg[0], $queryArg[1]);
                }
                else $query_Class -> bindParam($index + 1, $queryArg[0]);
            }
        }
        else {
            global $connect;
            $query_Class = $connect -> prepare(
                "SELECT * FROM `". $ClassName. "`");
        }
        if(!$query_Class -> execute()) {
            $EXIT_STATE = $ClassName. " query is failed!";
            return NULL;
        }
        if($query_Class -> rowCount() > 0){
            $ClassList = [];
            while($aClass = $query_Class -> fetch(PDO::FETCH_ASSOC)) {
                $aClassAttr = [];
                foreach($validArgs as $validArg) 
                    array_push($aClassAttr, $aClass[$validArg[0]]);
                array_push($ClassList, new $ClassType($aClassAttr));
            }
            $EXIT_STATE = $ClassName. " query is success!";
            return $ClassList;
        }
        else {
            $EXIT_STATE = "No match ". $ClassName. " found!";
            return [];
        }
    }

    function edit_Class(&$Class, $ClassName, $validArgs, $args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }
        
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
        $ClassIDName = strtolower($ClassName). "ID";
        $edit_Class = $connect -> prepare(
            "UPDATE `". $ClassName. "` SET ". $editStatement. 
            "WHERE ". $ClassIDName. " = \"". $Class -> $ClassIDName. "\"");
        foreach($editArgs as $index => $editArg) {
            if($editArg[1] != NULL) {
                if(is_array($editArg[1])) $edit_Class -> bindParam(
                    $index + 1, $editArg[0], $editArg[1][0], $editArg[1][1]);
                else $edit_Class -> bindParam(
                    $index + 1, $editArg[0], $editArg[1]);
            }
            else $edit_Class -> bindParam($index + 1, $editArg[0]);
        }
        if($edit_Class -> execute()) {
            foreach($editArgs as $editArg) $Class -> $editArg[2] = $editArg[0];
            $EXIT_STATE = $ClassName. " edit is success!";
            return $Class;
        }
        else {
            $EXIT_STATE = $ClassName. " edit is failed!";
            return NULL;
        }
    }

    function delete_Class($ClassName, $validArgs, $args, &$EXIT_STATE) {
        if(!is_array($args)) {
            $EXIT_STATE = "Pass args is not an array!";
            return NULL;
        }

        if($args) {
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
            $delete_Class = $connect -> prepare(
                "DELETE FROM `". $ClassName. "` WHERE ". $deleteCondition);
            foreach($deleteArgs as $index => $deleteArg) {
                if($deleteArg[1] != NULL) {
                    if(is_array($deleteArg[1])) $delete_Class -> bindParam(
                        $index + 1, $deleteArg[0], $deleteArg[1][0], $deleteArg[1][1]);
                    else $delete_Class -> bindParam(
                        $index + 1, $deleteArg[0], $deleteArg[1]);
                }
                else $delete_Class -> bindParam($index + 1, $deleteArg[0]);
            }
        }
        else {
            global $connect;
            $delete_Class = $connect -> prepare(
                "DELETE FROM `". $ClassName. "`");
        }
        if($delete_Class -> execute()) {
            $EXIT_STATE = $ClassName. " delete is success!";
            return NULL;
        }
        else {
            $EXIT_STATE = $ClassName. " delete is failed!";
            return NULL;
        }
    }

?>