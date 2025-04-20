<?php

    $hostname = "localhost";
    $username = "root";
    $pass = "";
    $db = "hb";
    $con = mysqli_connect($hostname,$username,$pass,$db);
    if (!$con) {
        die("cannot connect to database".mysqli_connect_errno());
    }

    function filteration($data){
        foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
        return $data;
    }
    function select($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con,$sql)) {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be prepared - Select");
            }
            
        }
        else{
            die("Query cannot be executed - Select");
        }
    }

    function selectAll($table){
        $con = $GLOBALS["con"];
        $q = "SELECT * FROM $table";
        $res = mysqli_query($con,$q);
        return $res;
    }

    function update($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con,$sql)) {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be prepared - Update");
            }
            
        }
        else{
            die("Query cannot be executed - Update");
        }
    }
    
    function insert($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con,$sql)) {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be prepared - Insert");
            }
            
        }
        else{
            die("Query cannot be executed - Insert");
        }
    }

    function deleteq($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con,$sql)) {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be prepared - Delete");
            }
            
        }
        else{
            die("Query cannot be executed - delete");
        }
    }
    
?>