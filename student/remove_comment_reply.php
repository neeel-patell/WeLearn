<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $reply = $_POST['reply'];
    
    $query = "delete from comment_reply where id=$reply";
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Reply deleted"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>