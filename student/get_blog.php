<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $now_date = new DateTime(date('Y-m-d'));
    $query = "select id,subject,date from blog order by date desc";
    $result = $conn->query($query);

    while($row = $result->fetch_array()){
        $date = date('Y-m-d',strtotime($row['date']));
        $time = new DateTime($date);
        $diff = $now_date->diff($time);
        $diff = $diff->format('%a');
        $image = base64_encode(file_get_contents("../images/blog/".$row['id'].".jpg"));
        if($diff <= 30){
            array_push($data,array("id"=>$row['id'],"subject"=>$row['subject'],"date"=>date("dS F Y",strtotime($date)),"image"=>$image));
        }
    }

    echo json_encode(array("data"=>$data));
?>