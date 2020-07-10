<?php
    require '../../connection.php';
    $conn = getConn();

    $comment = $_GET['comment'];
    $video = $_GET['video'];
    $query = array();
    $query = "DELETE FROM comment_reply where comment_id=$comment;";
    $query .= "DELETE FROM video_comment where id=$comment;";
    
    if($conn->multi_query($query) == true){
        header("location: view_comments.php?msg=The comment and related replies are Deleted&id=$video");
    }
    else{
        header("location: view_comments.php?msg=Something Went Wrong...&id=$video");
    }
?>