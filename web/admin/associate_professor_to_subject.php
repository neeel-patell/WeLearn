<?php
    require "../../connection.php";
    $conn = getConn();

    $medium = $_POST['medium'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];

    $query = "INSERT INTO class_subject(class_id,subject_id) VALUES($class,$subject)";
    if($conn->query($query) == true){
        header("location: associate_subject.php?msg=Subject has been Associated with selected class");
    }
    else{
        header("location: associate_subject.php?msg=Something went wrong");
    }
?>