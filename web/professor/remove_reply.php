<?php
    require '../../connection.php';
    $conn = getConn();

    $reply = $_GET['reply'];
    $video = $_GET['video'];

    $query = "DELETE FROM comment_reply where id=$reply";
    if($conn->query($query) == true){
        header("location: view_comments.php?msg=Reply Deleted&id=$video");
    }
    else{
        header("location: view_comments.php?msg=Something Went Wrong...&id=$video");
    }
?>