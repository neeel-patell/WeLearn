<?php
    $msg = 0;
    include_once 'validate_professor.php'; 
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $associated_subjects = $conn->query("SELECT subject_id from subject_professor where login_id=$login");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Add Topic</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Add Topic <i class="far fa-edit"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">
                <form action="insert_video.php" method="post" class="card border-success p-3" data-parsley-validate enctype="multipart/form-data">
                    
                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>
            
                    <div class="form-group mt-2">
                        <label class="label">Subject: <span class="text-danger">*</span></label>
                        <select class="form-control" name="subject" id="subject" required>
                            <option value="" selected>- - - Select Subject - - -</option>
                            
                            <?php
                                while($row = $associated_subjects->fetch_array()){ 
                                    $class_subject = $conn->query("SELECT class_id,subject_id from class_subject where id=".$row['subject_id']);
                                    $class_subject = $class_subject->fetch_array();
                                    $subject = $conn->query("SELECT `name` from `subject` where id=".$class_subject['subject_id']);
                                    $subject = $subject->fetch_array();
                                    $class = $conn->query("SELECT `name` from `class` where id=".$class_subject['class_id']);
                                    $class = $class->fetch_array();
                            ?>
                            <option value="<?php echo $row['subject_id']; ?>"><?php echo $class['name']." - ".$subject['name']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">Topic Name: <span class="text-danger">*</span></label>
                        <select name="topic" id="topic" class="form-control" required>
                            <option value="" selected>- - - Select Subject - - -</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">Choose Video: <span class="text-danger">*</span></label>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="video_label">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="video" id="video" aria-describedby="video_label" accept="video/mp4" required>
                                <label class="custom-file-label" id="file_name" for="video">Choose Video to Upload(Only MP4 and MKV)</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">Video Name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" maxlength="50" class="form-control" placeholder="Enter Video Name" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">At Index(Optional):</label>
                        <input type="text" name="index" data-parsley-type="number" maxlength="2" class="form-control" placeholder="Enter Index of video(optional)">
                    </div>
                    <div class="container w-50 mt-2">
                        <input type="submit" value="Add Video" class="form-control btn-success">
                    </div>
                </form>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
            $("#subject").change(function(){
                var subject = $("#subject").val();
                var options = "<option>- - - Select Topic - - -</option>";
                $.ajax({
                    type: 'POST',
                    url: "../api/get_topic.php",
                    data: {subject:subject},
                    dataType: "text",
                    success: function(data) {
                        data = JSON.parse(data);
                        for(var i=0; i<data.data.length; i++){
                            var string = "<option value='"+data.data[i].id+"'>"+data.data[i].name+"</option>";
                            options = options + string;
                        }
                        $("#topic").html(options);
                    }
                });
            });
            $('#video'). change(function(e){
                var file_name = e.target.files[0].name;
                $("#file_name").html(file_name);
                var type = file_name.substring(file_name.lastIndexOf('.') + 1);
                type = type.toLowerCase();
                if(type != "mp4" && type != "mkv"){
                    $('#video').val('');
                    $("#file_name").html("Choose Video to Upload(Only MP4 and MKV)");
                    alert("Select File Again of MP4 or MKV format");
                }
            });
        </script>
    </body>
</html>