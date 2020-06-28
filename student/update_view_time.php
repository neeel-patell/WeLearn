<?php
    header('content-type: application/json');
    require '../connection.php';
    $conn = getConn();
    $data = array();

    $video = $_POST['video'];
    $user = $_POST['user'];
    $time = $_POST['time'];
    
    $query = "SELECT `time` from video_view_time where video_id=$video AND user_id=$user";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) == 0){
        $query = "INSERT into video_view_time(video_id,user_id,`time`) VALUES($video,$user,'$time')";
        if($conn->query($query) == false){
            array_push($data,array("message"=>"View not updated"));
        }
        else{
            array_push($data,array("message"=>"view Updated"));
        }
    }
    else{
        $query = "UPDATE video_view_time
                  SET `time`='$time'
                  WHERE video_id=$video AND user_id=$user";
        if($conn->query($query) == false){
            array_push($data,array("message"=>"View not Updated"));
        }
        else{
            array_push($data,array("message"=>"view Updated"));
        }
    }
    echo json_encode(array("data"=>$data));
?>