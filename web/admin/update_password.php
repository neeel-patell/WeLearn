<?php
    require '../../connection.php';
    session_start();
    $conn = getConn();
    $data = array();

    $login = $_SESSION['login'];
    $password = hash("sha256",$_POST['pass']);
    
    $query = "UPDATE login set password='$password' where id=$login";

    if($conn->query($query) == true){
        header('location: change_password.php?msg=Password Changed');
    }
    else{
        header('location: change_password.php?msg=Password has not changed');
    }
?>