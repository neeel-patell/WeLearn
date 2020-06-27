<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $id = $_POST['blog'];
    $query = "select subject,date,description,link from blog where id=$id";
    $result = $conn->query($query);
    $blog = $result->fetch_array();

    $image = base64_encode(file_get_contents("../images/blog/$id.jpg"));
    
    array_push($data,array("subject"=>$blog['subject'],"description"=>$blog['description'],"date"=>date('dS F Y',strtotime($blog['date'])),"link"=>$blog['link'],"image"=>$image));

    echo json_encode(array("data"=>$data));
?>