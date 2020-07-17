<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $tutorial = $_POST['tutorial'];
    $query = "SELECT id from tutorial where id=$tutorial";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    array_push($data,array("file"=>base64_encode(file_get_contents("../tutorials/".$row['id'].".pdf"))));
    
    echo json_encode(array("data"=>$data));
?>