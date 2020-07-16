<?php
    include '../../connection.php';
    include '../functions/remove_topic.php';
    if(isset($_GET['id']) == false || isset($_GET['class']) == false){
        header('location: view_class.php');
    }
    else{
        $conn = getConn();
        $id = $_GET['id'];
        $class = $_GET['class'];
        $conn->query("DELETE from subject_professor where subject_id=$id");
        $topics = $conn->query("SELECT id from topic where subject_id=$id");
        while($row = $topics->fetch_array()){
            delete_topic($row['id']);
        }
        $query = "DELETE FROM class_subject where id=$id";
        if($conn->query($query) == true){
            header("location: view_class_subject.php?id=$class&msg=Subject and associated all things are deleled");
        }
        else{
            header("location: view_class_subject.php?id=$class&msg=Something went wrong...");
        }
    }
?>