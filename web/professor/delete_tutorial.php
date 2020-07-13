<?php
    if(isset($_GET['id']) == false){
        header('location: view_tutorial.php');
    }
    else{
        include '../../connection.php';
        $conn = getConn();

        $id = $_GET['id'];
        $query = "delete from tutorial where id=$id";
        if($conn->query($query) == true){
            header('location: view_tutorial.php?msg=Tutorial has been deleted');
        }
        else{
            header('location: view_tutorial.php?msg=Tutorial is not deleted, Something went wrong...');
        }
    }
?>