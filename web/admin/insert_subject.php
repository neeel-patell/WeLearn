<?php
    require '../../connection.php';
    $conn = getConn();

    $subject = $_POST['subject'];
    $query = "INSERT INTO `subject`(`name`) VALUES('$subject')";
    if($conn->query($query) == true){
        header("location: view_subject.php?msg=$subject Added Successfully");
    }
    else{
        header('location: view_subject.php?msg=Something went wrong');
    }
?>