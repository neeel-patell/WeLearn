<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $comment = $_POST['comment'];
    $description = $_POST['description'];
    $user = $_POST['user'];

    $query = 'INSERT into comment_reply(comment_id,user_id,`description`) VALUES('.$comment.','.$user.','.'"'.$description.'")';
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Reply Added"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>