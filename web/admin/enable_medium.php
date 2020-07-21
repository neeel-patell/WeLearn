<?php
    include '../../connection.php';
    $conn = getConn();

    $medium = $_GET['id'];
    $conn->query("UPDATE login set active=1 WHERE medium_id=$medium AND user_type=2");
    $class = $conn->query("SELECT id from class where medium_id=$medium");
    $class_array = array();
    while($row = $class->fetch_array()){
        array_push($class_array,$row['id']);
    }
    $class = implode(",",$class_array);
    $conn->query("UPDATE class set active=1 WHERE medium_id=$medium");
    $query = "UPDATE medium set active=1 where id=$medium";
    if($conn->query($query) == true){
        header('location: show_medium.php?msg=Medium and associated student accounts and classes are disabled');
    }
    else{
        header('location: show_medium.php?msg=Something\'s wrong');
    }
?>