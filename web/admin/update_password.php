<?php
    require '../../connection.php';
    require '../../mail/mail_sender.php';
    session_start();
    $conn = getConn();

    $login = $_SESSION['login'];
    $password = hash("sha256",$_POST['pass']);
    $old_password = hash("sha256",$_POST['old_pass']);

    $result = $conn->query("SELECT email from login where id=$login AND `password`='$old_password'");
    if(mysqli_num_rows($result) == 0){
        header('location: change_password.php?msg=Your old password doesn\'t match');
    }
    else{
        if($old_password == $password){
            header('location: change_password.php?msg=Your old password and new password is same try other one');
        }
        else{
            $query = "UPDATE login 
                      SET `password`='$password'
                      where id=$login";
            if($conn->query($query) == true){
                $result = $result->fetch_array();
                $email = $result['email'];
                session_unset();
                sendMail($email,"Password Change","Your Password is changed for email account $email for admin account, please take action if you didn't do that");
                header('location: ../index.php?msg=Please Login Again with new Password');
            }
            else{
                header('location: change_password.php?msg=Password hasn\'t changed, Please try again');
            }
        }
    }
?>