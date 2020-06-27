<?php
    session_start();
    include_once '../../connection.php';
    if(isset($_SESSION['login']) == true && isset($_SESSION['user_type']) == true){
        $login = $_SESSION['login'];
        if($_SESSION['user_type'] != 0 || $login <= 0){
            session_unset();
            header("location: ./index.php?msg=Please Login Again");
        }
        else{
            $conn = getConn();
            $result = $conn->query("select first_name,last_name from login where id=$login");
            $result = $result->fetch_array();
            $fullname = $result['first_name']." ".$result['last_name'];
        }
    }
    else{
        session_unset();
        header("location: ../index.php?msg=Please Login Again");
    }
?>