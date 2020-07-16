<?php
    include '../../connection.php';
    if(isset($_GET['id']) == false){
        header('location: view_professor.php?msg=Wrong Request');
    }
    else{
        $id = $_GET['id'];
        $conn = getConn();
        $conn->query("DELETE FROM subject_professor where login_id=$id");
        $query = "DELETE FROM login where id=$id";
        if($conn->query($query) == true){
            header("location: view_professor.php?msg=Professor ID has been removed...");
        }
        else{
            header("location: view_professor.php?msg=Something went wrong...");
        }
    }
?>