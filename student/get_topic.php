<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $class = $_POST['class'];
    $subject = $_POST['subject'];

    $query = "select id from class_subject where class_id=$class and subject_id=$subject";
    $result = $conn->query($query);
    $subject = $result->fetch_array();

    $query = "select id,name from topic where subject_id=".$subject['id']." order by `index` asc";
    $result = $conn->query($query);
    
    while($row = $result->fetch_array()){
        array_push($data,array("id"=>$row['id'],"name"=>$row['name']));
    }

    echo json_encode(array('data'=>$data));
    
?>