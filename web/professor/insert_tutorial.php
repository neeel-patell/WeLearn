<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Upload Video</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div style="height: 100vh; padding: 30vh 40%;" class="container-fluid text-center">
            <div class="spinner-border text-primary" role="status" style="width: 20rem; height:20rem;">
                <span class="sr-only">Loading...</span>
            </div>
            <h5 class="mt-3">Please Wait till Tutorial is uploading . . .</h5>
        </div>
    </body>
</html>
<?php
    include '../../connection.php';
    $conn = getConn();

    $topic = $_POST['topic'];
    $name = $_POST['name'];
    $pdf_file = $_FILES['pdf_file'];
    
    $query = "INSERT into tutorial(`name`,topic_id) VALUES('$name',$topic)";
    
    if($conn->query($query) == true){
        $select_query = "SELECT id from tutorial where `name`='$name' AND topic_id=$topic order by id desc";
        $result = $conn->query($select_query);
        $result = $result->fetch_array();
        $id = $result['id'];
        move_uploaded_file($pdf_file['tmp_name'],"../../tutorials/$id.pdf");
        header('location: add_tutorial.php?msg=Tutorial Uploaded Successfully');
    }
    else{
        header('location: add_tutorial.php?msg=Tutorial is not uploaded');
    }
    
?>