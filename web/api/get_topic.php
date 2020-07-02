<?php
    header('content-type: application/json');
    $data = array();
    include '../../connection.php';
    $conn = getConn();

    $subject = $_POST['subject'];

    $query = "select id,name from topic where subject_id=$subject order by `index` asc";
    $result = $conn->query($query);
    
    while($row = $result->fetch_array()){
        array_push($data,array("id"=>$row['id'],"name"=>$row['name']));
    }

    echo json_encode(array('data'=>$data));
?>