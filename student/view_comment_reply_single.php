<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $comment = $_POST['comment'];
    $query = "SELECT id,`description`,user_id from comment_reply where comment_id=$comment order by id desc";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) != 0){
        $row = $result->fetch_array();
        $query = "SELECT first_name,last_name from login where id=".$row['user_id'];
        $user = $conn->query($query);
        $user = $user->fetch_array();
        $user = $user['first_name']." ".$user['last_name'];
        array_push($data,array("name"=>$user,"user"=>$row['user_id'],"description"=>$row['description'],"id"=>$row['id']));
    }
    
    echo json_encode(array("data"=>$data));
?>