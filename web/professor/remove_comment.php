<?php
    require_once '../../connection.php';
    require '../functions/remove_comment.php';
    $conn = getConn();

    $comment = $_GET['comment'];
    $video = $_GET['video'];
    
    if(delete_comment($comment) == true){
        header("location: view_comments.php?msg=The comment and related replies are Deleted&id=$video");
    }
    else{
        header("location: view_comments.php?msg=Something Went Wrong...&id=$video");
    }
?>