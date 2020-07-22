<?php
    include '../../connection.php';
    $conn = getConn();

    if(!isset($_POST['id']) || !isset($_POST['class'])){
        header('location: view_class.php?msg=Wrong Request');
    }
    else{
        $id = $_POST['id'];
        $class = $_POST['class'];
        $query = "UPDATE class
                  SET name='$class'
                  WHERE id=$id";
        if($conn->query($query) == true){
            header('location: view_class.php?msg=Class Name is changed successfully');
        }
        else{
            header('location: view_class.php?msg=Something went wrong');
        }
    }
?>