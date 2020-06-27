<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $comment = $_POST['comment'];
    $description = $_POST['description'];

    $query = "UPDATE video_comment SET
              `description`='$description'
              where id=$comment";
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Comment Updated"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>