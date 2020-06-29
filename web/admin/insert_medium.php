<?php
    require '../../connection.php';
    $conn = getConn();

    $medium = $_POST['medium'];
    $query = "INSERT INTO medium(`name`) values('$medium')";
    if($conn->query($query) == true){
        header('location: show_medium.php?msg=Medium Added Successfully');
    }
    else{
        header('location: show_medium.php?msg=Already Exist ...');
    }
?>