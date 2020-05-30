<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();
    
    $id = $_POST['id'];

    $query = "select class_id from login where id=$id";
    $result = $conn->query($query);
    $user = $result->fetch_array();
    
    $query = "SELECT subject.id'id',subject.name'name' FROM `subject` INNER JOIN class_subject WHERE `subject`.`id` = `class_subject`.`subject_id` AND class_subject.`class_id` =".$user['class_id'];
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        array_push($data,array("id"=>$row['id'],"name"=>$row['name']));
    }
    echo json_encode(array("data"=>$data));
    
?>