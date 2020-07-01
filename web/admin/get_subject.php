<?php
    require '../../connection.php';
    $class = $_POST['class'];
    $conn = getConn();
    $query = "select id,name from subject";
    $result = $conn->query($query);
    echo '<option value="">- - - Select Subject - - -</option>';
    while($row = $result->fetch_array()){
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
?>