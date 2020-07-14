<?php
    if(isset($_GET['id']) == false){
        header('location: view_video.php');
    }
    else{
        include '../../connection.php';
        $conn = getConn();

        $id = $_GET['id'];
        $query = "delete from video_view_time where video_id=$id;
                  delete from video_comment where video_id=$id;
                  delete from video where id=$id;";
        if($conn->multi_query($query) == true){
            unlink("../../video/$id.mp4");
            header('location: view_video.php?msg=Video and associated comments have been deleted');
        }
        else{
            header('location: view_video.php?msg=Video is not deleted, Something went wrong...');
        }
    }
?>