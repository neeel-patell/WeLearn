<?php
    require "../../connection.php";
    $conn = getConn();

    $subject = $_POST['subject'];
    $topic = $_POST['topic'];
    $index = $_POST['index'];
    if($index != ""){
        $q = "SELECT id from topic where `index`=$index and subject_id=$subject";
        echo $q;
        $result = $conn->query($q);
        if(mysqli_num_rows($result) != 0){
            $q = "UPDATE topic set `index`=`index`+1 where `index`>=$index AND `index`<255 AND subject_id=$subject";
            if($conn->query($q) == false){
                header("location: associate_professor.php?msg=Something Went Wrong");
            }
        }
        $query = "INSERT INTO topic(subject_id,`name`,`index`) VALUES($subject,'$topic',$index)";
    }
    else{
        $query = "INSERT INTO topic(subject_id,`name`) VALUES($subject,'$topic')";
    }
    if($conn->query($query) == true){
        header("location: add_topic.php?msg=Topic Added to Subject");
    }
    else{
        header("location: add_topic.php?msg=Something Went Wrong");
    }
?>