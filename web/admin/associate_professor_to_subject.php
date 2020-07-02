<?php
    require "../../connection.php";
    $conn = getConn();

    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $professor = $_POST['professor'];

    $query = "SELECT id from class_subject where class_id=$class and subject_id=$subject";
    $result = $conn->query($query);
    $result = $result->fetch_array();
    $subject = $result['id'];
    $query = "INSERT INTO subject_professor(subject_id,login_id) VALUES($subject,$professor)";
    if($conn->query($query) == true){
        header("location: associate_professor.php?msg=Subject has been Associated to Professor");
    }
    else{
        header("location: associate_professor.php?msg=Please associate subject to that class first");
    }
?>