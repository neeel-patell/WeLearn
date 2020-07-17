<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $topic = $_POST['topic'];
    $query = "SELECT id,`name` from tutorial where topic_id=$topic";
    $result = $conn->query($query);

    while($row = $result->fetch_array()){
        array_push($data,array("name"=>$row['name'],"file"=>base64_encode(file_get_contents("../tutorials/".$row['id'].".pdf"))));
    }

    echo json_encode(array("data"=>$data));
?>