<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $reply = $_POST['reply'];
    $description = $_POST['description'];

    $query = 'UPDATE comment_reply SET
              `description`="'.$description.'"
              where id='.$reply;
    if($conn->query($query) == true){
        array_push($data,array("message"=>"Reply Updated"));
    }
    else{
        array_push($data,array("message"=>"Something went wrong"));
    }

    echo json_encode(array("data"=>$data));
?>