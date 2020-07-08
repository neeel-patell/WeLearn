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
            <h5 class="mt-3">Please Wait till video is uploading . . .</h5>
        </div>
    </body>
</html>
<?php
    include '../../connection.php';
    $conn = getConn();

    $topic = $_POST['topic'];
    $name = $_POST['name'];
    $video = $_FILES['video'];
    $name = $_POST['name'];
    $index = $_POST['index'];
    
    if($index != 0){
        $result = $conn->query("SELECT id from video where `index`=$index and topic_id=$topic");
        if(mysqli_num_rows($result) != 0){
            $query = "UPDATE video
                      set `index` = `index` + 1
                      where `index`>=$index and `index`<255 and topic_id=$topic";
            if($conn->query($query) == false){
                header("location: add_video.php?msg=Something went wrong...");
            }
        }
        $query = "INSERT INTO video(`name`,topic_id,`index`) VALUES('$name',$topic,$index)";
        $select_query = "SELECT id from video where topic_id=$topic AND `name`='$name' AND `index`=$index order by id desc";
    }
    else{
        $query = "INSERT INTO video(`name`,topic_id) VALUES('$name',$topic)";
        $select_query = "SELECT id from video where topic_id=$topic AND `name`='$name' AND `index`=255 order by id desc";
    }

    if($conn->query($query) == true){
        $result = $conn->query($select_query);
        $result = $result->fetch_array();
        $id = $result['id'];
        move_uploaded_file($video['tmp_name'],"../../video/$id.mp4");
        header('location: add_video.php?msg=Video Uploaded Successfully');
    }
    else{
        header('location: add_video.php?msg=Video is not uploaded');
    }
    
?>