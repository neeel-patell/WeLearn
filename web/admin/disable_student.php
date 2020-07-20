<?php
    include '../../connection.php';
    if(!isset($_GET['id'])){
        header('location: view_student.php');
    }
    else{
        $conn = getConn();
        $id = $_GET['id'];
        $query = "UPDATE login
                  SET active = 0
                  WHERE id=$id";
        if($conn->query($query) == true){
            header("location: view_student.php?msg=Selected student account is deactivated");
        }
        else{
            header("locatiom: view_student.php?msg=Something went wrong, Selected student account is not deactivated");
        }
    }
?>