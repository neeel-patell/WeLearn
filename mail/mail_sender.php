<?php
    
    require "PHPMailerAutoload.php";
    function sendMail($receiver,$subject,$body){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = "welearnntheapp@gmail.com";
        $mail->Password = "Unpr#d!ct@bl#";
        $mail->setFrom("welearnntheapp@gmail.com", "We Learn Beta - The App");
        $mail->addReplyTo("welearnntheapp@gmail.com");
        $mail->isHTML(true);
        $mail->addAddress($receiver);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if(!$mail -> Send()){
            return false;
        }
        else{
            return true;
        }
    }
?>