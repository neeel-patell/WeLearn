<?php
    header('content-type: application/json');
    include 'connection.php';
    $conn = getConn();
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $medium = $_POST['medium'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    
    $date_of_birth = date("Y-m-d",strtotime($date_of_birth));
    $password = hash("sha256",$password);
    
    $query = "insert into login(email,mobile,password,user_type,first_name,last_name,gender,class_id,date_of_birth,medium_id,address) values
    ('$email',$mobile,'$password',$user_type,'$first_name','$last_name',$gender,$class,'$date_of_birth',$medium,'$address')";
    
    if($conn->query($query) == true){
        echo json_encode(array("message"=>array("success"=>"Successfully Registered")));
    }
    else{
        echo json_encode(array("message"=>array("error"=>"Email or mobile registered")));
    }
?>