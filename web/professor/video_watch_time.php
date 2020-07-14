<?php
    include_once 'validate_professor.php';
    $video = 0;
    if(isset($_GET['id']) == false){
        header('location: view_video.php');
    }
    else{
        $video = $_GET['id'];
        if($video <= 0){
            header('location: view_video.php?msg=Wrong Request');
        }
    }
    $query = "SELECT user_id,`time` from video_view_time where video_id=$video";
    $result = $conn->query($query);
    $video_name = $conn->query("SELECT name from video where id=$video");
    $video_name = $video_name->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - </title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white text-monospace"><?php echo "[".$video_name['name']."]'s Viewers"; ?> <i class="far fa-play-circle"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">
                <div class="table-responsive mt-4 card p-3">
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $sr=1;
                                while($row = $result->fetch_array()){ 
                                    $user = $conn->query("SELECT first_name,last_name from login where id=".$row['user_id']);
                                    $user = $user->fetch_array();
                            ?>
                            <tr>
                                <th><?php echo $sr++; ?></th>
                                <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
                                <td><?php echo $row['time']; ?></td>
                            </tr>
                            <?php } ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>