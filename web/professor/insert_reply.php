<?php
    session_start();
    require '../../connection.php';
    $conn = getConn();

    $reply = $_POST['reply'];
    $comment = $_POST['comment'];
    $login = $_SESSION['login'];
    $video = $_POST['video'];

    $query = "INSERT INTO comment_reply(description,comment_id,user_id) VALUES('$reply',$comment,$login)";
    if($conn->query($query) == true){
        header("location: view_comments.php?msg=Reply Added&id=$video");
    }
    else{
        header("location: view_comments.php?msg=Something Went Wrong...&id=$video");
    }
?>