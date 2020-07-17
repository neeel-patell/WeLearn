<?php
    include '../functions/remove_video.php';
    
    include_once '../../connection.php';
    function delete_topic($topic){
        $conn = getConn();
    
        $videos = $conn->query("SELECT id from video where topic_id=$topic");
        while($row = $videos->fetch_array()){
            if(delete_video($row['id']) == true){
                echo "YES";
            }
        }
        
        $tutorials = $conn->query("SELECT id from tutorial where topic_id=$topic");
        while($row = $tutorials->fetch_array()){
            if(file_exists("../../tutorials/".$row['id'].".pdf")){
                unlink("../../tutorials/".$row['id'].".pdf");
            }
        }
        $conn->query("DELETE from tutorial where topic_id=$topic");
        $query = "DELETE from topic where id=$topic";
        if($conn->query($query) == true){
            return true;
        }
        else{
            return false;
        }
    }
?>