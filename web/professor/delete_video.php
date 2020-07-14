<?php
    include '../functions/remove_video.php';
    if(isset($_GET['id']) == false){
        header('location: view_video.php');
    }
    else{
        $id = $_GET['id'];
        if(delete_video($id) == true){
            header('location: view_video.php?msg=Video and associated comments have been deleted');
        }
        else{
            header('location: view_video.php?msg=Video is not deleted, Something went wrong...');
        }
    }
?>