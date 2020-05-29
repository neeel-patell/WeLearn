<?php
    require '../connection.php';
    header('content-type: application/json');
    $conn = getConn();
    $data = array();

    $id = $_POST['id'];
    $image = $_POST['image'];
    file_put_contents("../images/profile/$id.jpg",base64_decode($image));

?>