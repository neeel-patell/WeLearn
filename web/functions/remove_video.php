<?php
    include_once '../../connection.php';
    include '../functions/remove_comment.php';
    
    function delete_video($id){
        $conn = getConn();
        $comments = $conn->query("SELECT id from video_comment where video_id=$id");
        while($row = $comments->fetch_array()){
            delete_comment($row['id']);
        }
        $conn->query("delete from video_view_time where video_id=$id");
        $query = "delete from video where id=$id;";
        if($conn->query($query) == true){
            if(file_exists("../../video/$id.mp4") == true)
                unlink("../../video/$id.mp4");
            return true;
        }
        else{
            return false;
        }
    }
?>