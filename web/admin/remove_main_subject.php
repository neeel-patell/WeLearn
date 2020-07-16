<?php
    include '../../connection.php';
    $conn = getConn();
    if(isset($_GET['id']) == false){
        header('location: view_subject.php');
    }
    else{
        $id = $_GET['id'];
        $query = "DELETE FROM subject where id=$id";
        if($conn->query($query) == true){
            header('location: view_subject.php?msg=Subject has been deleted...');
        }
        else{
            header('location: view_subject.php?msg=Please Remoe subject association first...');
        }
    }
?>