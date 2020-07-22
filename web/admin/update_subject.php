<?php
    include '../../connection.php';
    $conn = getConn();

    if(!isset($_POST['id']) || !isset($_POST['subject'])){
        header('location: view_subject.php?msg=Wrong Request');
    }
    else{
        $id = $_POST['id'];
        $name = $_POST['subject'];
        $query = "UPDATE `subject`
                  SET name='$name'
                  WHERE id=$id";
        if($conn->query($query) == true){
            header('location: view_subject.php?msg=Subject is renamed successfully');
        }
        else{
            header('location: view_subject.php?msg=Something went wrong');
        }
    }
?>