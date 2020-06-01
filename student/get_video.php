<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $topic = $_POST['topic'];

    $query = "select id,name from video where topic_id=$topic ORDER BY `index`";
    $result = $conn->query($query);

    while($row = $result->fetch_array()){
        array_push($data,array("id"=>$row['id'],"name"=>$row['name']));
    }

    echo json_encode(array("data"=>$data));
?>