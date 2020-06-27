<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $video = $_POST['video'];
    $user = $_POST['user'];
    $description = $_POST['description'];

    $query = "INSERT into video_comment(video_id,user_id,`description`) VALUES($video,$user,'$description')";
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Comment Placed"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>