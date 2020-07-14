<?php
    require_once '../../connection.php';
    
    function delete_comment($comment){
        $query = "DELETE FROM comment_reply where comment_id=$comment;";
        $query .= "DELETE FROM video_comment where id=$comment;";
        $conn = getConn();

        if($conn->multi_query($query) == true){
            return true;
        }
        else{
            return false;
        }   
    }
?>