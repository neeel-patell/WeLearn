<?php
    session_start();
    require '../connection.php';
    $conn = getConn();

    $email = $_POST['email'];
    $password = hash("sha256",$_POST['password']);

    $query = "select user_type,active,id,first_name,last_name,class_id from login where email = '$email' and password = '$password'";
    $result = $conn->query($query);
    
    if(mysqli_num_rows($result) != 0){
        $row = $result->fetch_array();
        if($row['active'] == 0){
            header('location: index.php?msg=You are disabled by Admin');
        }
        else{
            $user_type = $row['user_type'];
            $_SESSION['login'] = $row['id'];
            $_SESSION['user_type'] = $user_type;
            if($user_type == 0){
                header('location: admin/');
            }
            else if($user_type == 1){
                header('location: professor/');
            }
            else{
                header('location: index.php?msg=Students have to use Application');
            }
        }
    }
    else{
        $result = $conn->query("select id from login where email = '$email'");
        if(mysqli_num_rows($result) == 0){
            header("location: index.php?msg=Email Not Registered");
        }
        else{
            header('location: index.php?msg=Wrong Password');
        }
    }
?>