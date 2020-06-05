<?php
    header('content-type: application/json');
    require '../connection.php';
    require '../mail/mail_sender.php';
    $conn = getConn();
    $data = array();

    $email = $_POST['email'];
    
    $query = "select id from login where email='$email'";
    $result = $conn->query($query);
    
    if(mysqli_num_rows($result) != 0){
        $row = $result->fetch_array();
        $password = getRandom();
        $query = "update login set password='$password' where id=".$row['id'];
        if($conn->query($query) == true){
            $body = "Your new Password is $password for login and Make sure you change it if you want from your profile settings";
            sendMail($email,"New Password for login",$body);
            array_push($data,array("message"=>"Password has been sent to your email address"));
        }
    }
    else{
        array_push($data,array("message"=>"Email is not registered"));
    }

    echo json_encode(array("data"=>$data));

    function getRandom() { 
        $characters = '@!#$%^&*0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        for ($i = 0; $i < 8; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    }
?>