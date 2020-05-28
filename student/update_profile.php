<?php
    require '../connection.php';
    header('content_type: application/json');
    $conn = getConn();

    $data = array();

    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    
    $query = "update login
                set first_name='$first_name', last_name='$last_name',
                    mobile=$mobile, address='$address'
                where id=$id";

    if($conn->query($query) == true){
        array_push($data,array("message"=>"Profile Updated"));
    }

    echo json_encode(array("success"=>$data));
?>