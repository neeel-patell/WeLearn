<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $id = $_POST['blog'];
    $query = "select subject,created_at,description from blog where id=$id";
    $result = $conn->query($query);
    $blog = $result->fetch_array();

    array_push($data,array("subject"=>$blog['subject'],"description"=>$blog['description'],"date"=>date('dS F Y',strtotime($blog['created_at']))));

    echo json_encode(array("data"=>$data));
?>