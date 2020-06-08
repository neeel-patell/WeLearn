<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $id = $_POST['blog'];
    $query = "select subject,date from blog where id=$id";
    $result = $conn->query($query);
    $blog = $result->fetch_array();

    $description = file_get_contents("../files/blog/description/$id.txt");
    $link = file_get_contents("../files/blog/links/$id.txt");
    $image = base64_encode(file_get_contents("../images/blog/$id.jpg"));
    
    array_push($data,array("subject"=>$blog['subject'],"description"=>$description,"date"=>date('dS F Y',strtotime($blog['date'])),"link"=>$link,"image"=>$image));

    echo json_encode(array("data"=>$data));
?>