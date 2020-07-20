<?php
    include '../../connection.php';
    if(isset($_GET['id']) == false){
        header('location: view_student.php?msg=Wrong Request');
    }
    else{
        $id = $_GET['id'];
        $conn = getConn();
        $query = "DELETE FROM login where id=$id";
        if($conn->query($query) == true){
            header("location: view_student.php?msg=Student ID has been removed...");
        }
        else{
            header("location: view_student.php?msg=Something went wrong...");
        }
    }
?>