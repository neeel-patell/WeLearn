<?php
    header('content-type: application/json');
    require 'connection.php';
    $conn = getConn();

    $email = $_POST['email'];
    $password = hash("sha256",$_POST['password']);

    $query = "select user_type,active,id,first_name,last_name from login where email = '$email' and password = '$password'";
    $result = $conn->query($query);
    
    if(mysqli_num_rows($result) != 0){
        $row = $result->fetch_array();
        if($row['active'] == 0){
            echo json_encode(array("error"=>array("message"=>"You are disabled by admin")));
        }
        else{
            echo json_encode(array("data"=>array("user_type"=>$row['user_type'],"id"=>$row['id'],"first_name"=>$row['first_name'],"last_name"=>$row['last_name'])));
        }
    }
    else{
        $result = $conn->query("select id from login where email = '$email'");
        if(mysqli_num_rows($result) == 0){
            echo json_encode(array("error"=>array("message"=>"Email Not registered")));
        }
        else{
            echo json_encode(array("error"=>array("message"=>"Wrong Password")));
        }
    }
?>