<?php
    include '../../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $class = $_POST['class'];
    $result = $conn->query("SELECT first_name,last_name,id,medium_id,active from login where class_id=$class order by last_name,first_name");
    while($row = $result->fetch_array()){
        $class_name = $conn->query("select name from class where id=$class");
        $class_name = $class_name->fetch_array();
        $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
        $medium_name = $medium_name->fetch_array();
        array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
    }
    
    echo json_encode(array("data"=>$data));
?>