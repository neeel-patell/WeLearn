<?php
    include '../../connection.php';
    $conn = getConn();
    session_start();

    $login = $_SESSION['login'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $date_of_birth = str_replace("/","-",$_POST['date_of_birth']);
    $date_of_birth = date("Y-m-d",strtotime($date_of_birth));
    
    $query = "UPDATE login
              set first_name='$first_name', last_name='$last_name', mobile=$mobile, gender=$gender, `address`='$address', date_of_birth='$date_of_birth'
              where id=$login";
    if($conn->query($query) == true){
        header("location: edit_profile.php?msg=Profile Updated");
    }
    else{
        header("location: edit_profile.php?msg=Something went wrong, May It caused due to mobile number...");
    }
?>