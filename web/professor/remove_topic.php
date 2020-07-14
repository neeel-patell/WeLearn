<?php
    include '../functions/remove_topic.php';
    if(isset($_GET['id']) == false){
        header('location: view_topic.php');
    }
    else{
        $topic = $_GET['id'];
        
        if(delete_topic($topic) == true){
            header('location: view_topic.php?msg=Topic and it\'s asscociated videos with it\'s comments are deleted');
        }
        else{
            header('location: view_topic.php?msg=Something went wrong, try again ...');
        }
    }
?>