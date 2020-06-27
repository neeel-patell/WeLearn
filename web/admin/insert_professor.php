<?php
    include '../../connection.php';
    $conn = getConn();
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $medium = $_POST['medium'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['dob'];
    $date_of_birth = str_replace("/","-",$date_of_birth);
    $password = $_POST['pass'];
    $user_type = 1;
    
    $date_of_birth = date("Y-m-d",strtotime($date_of_birth));
    $password = hash("sha256",$password);
    
    $query = "insert into login(email,mobile,password,user_type,first_name,last_name,gender,class_id,date_of_birth,medium_id,address) values
    ('$email',$mobile,'$password',$user_type,'$first_name','$last_name',$gender,$class,'$date_of_birth',$medium,'$address')";
    
    if($conn->query($query) == true){
        $image = $_FILES['image'];
        $query = "select id from login where mobile = $mobile";
        $result = $conn->query($query);
        $row = $result->fetch_array();
        $id = $row['id'];
        move_uploaded_file($image['tmp_name'],"../../images/profile/$id.jpg");
        header("location: add_professor.php?msg=Professor Added");
    }
    else{
        header("location: add_professor.php?msg=Professor Exist");
    }
?>