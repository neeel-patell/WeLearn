<?php
    require '../../connection.php';
    $conn = getConn();

    $subject = str_replace('"','\"',$_POST['subject']);
    $description = str_replace('"','\"',$_POST['description']);

    $query = "INSERT INTO blog(`subject`,`description`) VALUES(\"$subject\",\"$description\")";
    if($conn->query($query) == true){
        header('location: add_blog.php?msg=Blog is Added Successfully');
    }
    else{
        header('location: add_blog.php?msg=Blog is not Added Successfully');
    }
?>