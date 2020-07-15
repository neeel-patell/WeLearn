<?php
    session_start();
    include '../../connection.php';

    $conn = getConn();
    $login = $_SESSION['login'];
    $image = $_FILES['profile_picture'];

    if(move_uploaded_file($image['tmp_name'],"../../images/profile/$login.jpg") == true){
        header('location: edit_profile_picture.php?msg=Profile Picture is changed');
    }
    else{
        header('location: edit_profile_picture.php?msg=Profile Picture is not changed');
    }
?>