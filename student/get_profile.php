<?php
    require '../connection.php';
    header('content-type: application/json');
    $conn = getConn();
    $id = $_POST['id'];
    $data = array();

    $query = "select id,first_name,last_name,email,mobile,date_of_birth,address,medium_id,class_id from login where id=$id";
    $result = $conn->query($query);
    $user = $result->fetch_array();
    $image = base64_encode(file_get_contents("../images/profile/".$user['id'].".jpg"));

    $result = $conn->query("select name from medium where id=".$user['medium_id']);
    $medium = $result->fetch_array();

    $result = $conn->query("select name from class where id=".$user['class_id']);
    $class = $result->fetch_array();

    $data = array("first_name"=>$user['first_name'],"last_name"=>$user['last_name'],"email"=>$user['email'],"mobile"=>$user['mobile'],"date_of_birth"=>$user['date_of_birth'],"address"=>$user['address'],"medium"=>$medium['name'],"class"=>$class['name'],"image"=>$image);

    echo json_encode(array("data"=>$data));
    
?>