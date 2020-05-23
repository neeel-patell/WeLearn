<?php
    require 'mail/mail_sender.php';
    require 'connection.php';
    header('content-type: application/json');
    $conn = getConn();
    $email = $_POST['email'];
    $query = "select email from login where email='$email'";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) != 0){
        echo json_encode(array("error"=>array("message"=>"Email Already Registered")));
    }
    else{
        $otp = rand(100000,999999);
        $body = "Your One time password for varification is <font color='blue' size='3'><b><u>$otp</u></b></font> and It will be valid for next 15 minutes. Use it for successful varification";
        if(sendMail($email,"OTP Varification for Registration",$body) == true){
            echo json_encode(array("data"=>array("otp"=>$otp)));
        }
        else{
            echo json_encode(array("error"=>array("message"=>"Email Address is not valid")));
        }
    }
?>