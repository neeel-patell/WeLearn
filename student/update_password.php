<?php
    require '../connection.php';
    header('content_type: application/json');
    $conn = getConn();

    $data = array();

    $id = $_POST['id'];
    $password = hash('sha256',$_POST['password']);
    $query = "update login
                set password='$password'
                where id=$id";

    if($conn->query($query) == true){
        array_push($data,array("message"=>"Password Changed"));
    }

    echo json_encode(array("success"=>$data));
?>