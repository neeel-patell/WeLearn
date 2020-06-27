<?php
    include '../../mail/mail_sender.php';
    include '../../connection.php';
    $email = $_POST['email'];
    $conn = getConn();
    $query = "select id from login where email='$email' and user_type=0";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) == 0){
        header('location: forgot_password.php?msg=You are Admin Use particular Mobile App');
    }
    else{
        $pass = getRandom();
        $query = "update `login` set `password`='".hash('sha256',$pass)."' where email='$email'";
        if($conn->query($query)){
            $body = "For $email, Your Password to login is <u>$pass</u> use it for login and make sure that you must change it";   
            sendMail($email,"New Password",$body);
            header("location: index.php?msg=Check Mail");
        }
        else{
            header("location: forgot_password.php?msg=Something Went Wrong");
        }
    }



    function getRandom() { 
        $characters = '@!#$%^&*0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        for ($i = 0; $i < 16; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    }
?>