<?php
    header('content-type: application/json');
    require 'connection.php';
    $conn = getConn();
    $data = array();
    $query = "select id,name from medium where active=1";
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        array_push($data,array("id"=>$row['id'],"name"=>$row['name']));
    }
    echo json_encode(array("data"=>$data));
?>