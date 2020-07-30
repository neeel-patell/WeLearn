<?php
    require '../../connection.php';
    $conn = getConn();

    if(!isset($_GET['id'])){
        header('location: view_blog.php');
    }
    else{
        $id = $_GET['id'];
        $query = "DELETE from blog where id=$id";
        if($conn->query($query) == true){
            header('location: view_blog.php?msg=Blog Deleted Successfully');
        }
        else{
            header('location: view_blog.php?msg=Blog is not Deleted');
        }
    }
?>