<?php
    if(isset($_GET['id']) == false){
        header('location: view_tutorial.php');
    }
    else{
        $id = $_GET['id'];
        header('content-type: application/pdf');
        @readfile("../../tutorials/$id.pdf");
    }
?>