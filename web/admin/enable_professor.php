<?php
    include '../../connection.php';
    if(!isset($_GET['id'])){
        header('location: view_professor.php');
    }
    else{
        $conn = getConn();
        $id = $_GET['id'];
        $query = "UPDATE login
                  SET active = 1
                  WHERE id=$id";
        if($conn->query($query) == true){
            header("location: view_professor.php?msg=Selected Professor account is activated");
        }
        else{
            header("locatiom: view_professor.php?msg=Something went wrong, Selected Professor account is not activated");
        }
    }
?>