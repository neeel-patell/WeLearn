<?php
    include '../../connection.php';
    $conn = getConn();

    if(!isset($_POST['id']) || !isset($_POST['medium'])){
        header('location: show_medium.php?msg=Wrong Request');
    }
    else{
        $id = $_POST['id'];
        $name = $_POST['medium'];
        $query = "UPDATE medium
                  set name='$name'
                  WHERE id=$id";
        if($conn->query($query) == true){
            header('location: show_medium.php?msg=Medium Renamed Successfully');
        }
        else{
            header('location: show_medium.php?msg=Something went wrong...');
        }
    }
?>