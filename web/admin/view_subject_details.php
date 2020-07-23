<?php
    include_once 'validate_admin.php';
    $msg = 0;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    if(!isset($_GET['id'])){
        header('location: view_class.php?msg=Wrong Request');
    }
    $subject = $_GET['id'];
    $subject_details = $conn->query("SELECT subject_id,class_id from class_subject where id=$subject");
    $subject_details = $subject_details->fetch_array();
    $subject_name = $conn->query("Select name from subject where id=".$subject_details['subject_id']);
    $subject_name = $subject_name->fetch_array();
    $class_name = $conn->query("Select name from class where id=".$subject_details['class_id']);
    $class_name = $class_name->fetch_array();
    $subject_professor = $conn->query("SELECT login_id from subject_professor where subject_id=$subject");
    $subject_professor = $subject_professor->fetch_array();
    $professor = $conn->query("SELECT first_name,last_name from login where id=".$subject_professor['login_id']);
    $professor = $professor->fetch_array();
    $topic = $conn->query("SELECT id,name from topic where subject_id=$subject");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Subject Details</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white"><?php echo "Class ".$class_name['name']." - ".$subject_name['name']." Details"; ?> <i class="fas fa-info-circle"></i> </h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">

                <h5>
                    Professor Name : 
                    <button class="btn btn-link p-0" onclick="location.href='view_professor_details.php?id=<?php echo $subject_professor['login_id'] ?>'">
                        <?php echo $professor['first_name']." ".$professor['last_name']; ?>
                    </button>
                </h5>

                <?php $sr=1; while($row = $topic->fetch_array()){ ?>
                <div class="card p-3 mt-3 mb-3 border-primary">
                    <div class="h5 text-center">
                        <?php echo $sr++.". ".$row['name']; ?>&nbsp; &nbsp; 
                        <button class="btn btn-success" onclick="load_data('<?php echo $row['id']; ?>')">View Details <i class="fas fa-caret-down"></i></button>
                    </div>
                    <div id="div_<?php echo $row['id']; ?>"></div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script>
            function load_data(id){
                $.ajax({
                    type : "POST",
                    url : "../api/get_video.php",
                    dataType : "html",
                    data : {topic : id},
                    success : function(data){
                        var videos = "";
                        data = JSON.parse(data);
                        videos = videos + "<hr><h6>Videos</h6>"
                        for(var i=0; i<data.data.length; i++){
                            videos = videos + 
                            (i+1)+". "+"<button class='btn btn-link p-0' onclick=\"location.href='../../video/"+data.data[i].id+".mp4'\">"+data.data[i].name+"</button><br>";
                        }
                        $("#div_"+id).html(videos);
                    }
                });
                $.ajax({
                    type : "POST",
                    url : "../api/get_tutorial.php",
                    dataType : "html",
                    data : {topic : id},
                    success : function(data){
                        var tutorial = "";
                        data = JSON.parse(data);
                        tutorial = tutorial + "<hr><h6>Tutorials</h6>"
                        for(var i=0; i<data.data.length; i++){
                            tutorial = tutorial + 
                                     (i+1)+". "+"<button class='btn btn-link p-0' onclick=\"location.href='../../tutorials/"+data.data[i].id+".pdf'\">"+data.data[i].name+"</button><br>";
                        }
                        var div_data = $("#div_"+id).html() + tutorial;
                        $("#div_"+id).html(div_data)
                    }
                });
            }
        </script>
    </body>
</html>