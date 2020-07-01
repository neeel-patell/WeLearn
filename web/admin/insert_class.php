<?php
    require '../../connection.php';
    $conn = getConn();

    $medium = $_POST['medium'];
    $class = $_POST['class'];
    
    $query = "INSERT INTO class(`name`,medium_id) values('$class',$medium)";
    if($conn->query($query) == true){
        header('location: view_class.php?msg=Class Added Successfully');
    }
    else{
        header('location: view_class.php?msg=Not Added');
    }
?>