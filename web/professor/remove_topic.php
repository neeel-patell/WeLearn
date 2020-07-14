<?php
    include '../functions/remove_video.php';
    if(isset($_GET['id']) == false){
        header('location: view_topic.php');
    }
    else{
        include_once '../../connection.php';
        $conn = getConn();
        $topic = $_GET['id'];
        
        $videos = $conn->query("SELECT id from video where topic_id=$topic");
        while($row = $videos->fetch_array()){
            if(delete_video($row['id']) == true){
                echo "YES";
            }
        }

        $conn->query("DELETE from tutorial where topic_id=$topic");
        $query = "DELETE from topic where id=$topic";
        if($conn->query($query) == true){
            header('location: view_topic.php?msg=Topic and it\'s asscociated videos with it\'s comments are deleted');
        }
        else{
            header('location: view_topic.php?msg=Something went wrong, try again ...');
        }
    }
?>