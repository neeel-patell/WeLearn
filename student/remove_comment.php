<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $comment = $_POST['comment'];
    
    $query = "delete from video_comment where id=$comment";
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Comment deleted"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>