<?php
    header('content-type: application/json');
    require '../../connection.php';
    $conn = getConn();
    $data = array();
    if(!isset($_POST['medium'])){
        $data = json_encode(array("message"=>"medium is not set"));
    }
    else{
        $medium = $_POST['medium'];
        $query = "select id,name from class where active=1 and medium_id=$medium";
        $result = $conn->query($query);
        echo '<option value="">- - - Select Class - - -</option>';
        while($row = $result->fetch_array()){
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
?>