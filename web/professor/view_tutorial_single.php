<?php
    $id = $_GET['id'];

    header('content-type: application/pdf');
    @readfile("../../tutorials/$id.pdf");
?>