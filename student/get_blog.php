<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $now_date = new DateTime(date('Y-m-d'));
    $query = "select id,subject,created_at from blog order by created_at desc";
    $result = $conn->query($query);

    while($row = $result->fetch_array()){
        $date = date('Y-m-d',strtotime($row['created_at']));
        $time = new DateTime($date);
        $diff = $now_date->diff($time);
        $diff = $diff->format('%a');
        if($diff <= 30){
            array_push($data,array("id"=>$row['id'],"subject"=>$row['subject'],"date"=>date("dS F Y",strtotime($date))));
        }
    }

    echo json_encode(array("data"=>$data));
?>