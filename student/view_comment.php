<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $video = $_POST['video'];
    $query = "SELECT id,`description`,user_id from video_comment where video_id=$video";
    $result = $conn->query($query);

    while($row = $result->fetch_array()){
        $query = "SELECT first_name,last_name from login where id=".$row['user_id'];
        $user = $conn->query($query);
        $user = $user->fetch_array();
        $user = $user['first_name']." ".$user['last_name'];
        array_push($data,array("name"=>$user,"description"=>$row['description'],"id"=>$row['id']));
    }
    
    echo json_encode(array("data"=>$data));
?>