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
        <title>Welearn - Professor - Video List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Video List <i class="fas fa-film"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-2">
                <div class="table-responsive p-3">

                    <?php if($msg !== 0){ ?>
                    <div class="alert alert-secondary text-center h6"><?php echo $msg; ?></div>
                    <?php } ?>

                    <select class="form-control mb-3" name="subject" id="subject" required>
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
                    <select name="topic" id="topic" class="form-control mb-5" required>
                        <option value="" selected>- - - Select Topic - - -</option>
                    </select>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th class="w-25">Sr. No</th>
                            <th>Video Name</th>
                            <th>Index</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="video_table"></tbody>
                    </table>
                </div>
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
            $("#topic").change(function(){
                var topic = $("#topic").val();
                var table = "";
                $.ajax({
                    type: 'POST',
                    url: "../api/get_video.php",
                    data: {topic:topic},
                    dataType: "text",
                    success: function(data) {
                        data = JSON.parse(data);
                        for(var i=0; i<data.data.length; i++){
                            var string = "<tr>"+
                                         "<td>"+(i+1)+"</td>"+
                                         "<td>"+data.data[i].name+"</td>"+
                                         "<td>"+data.data[i].index+"</td>"+
                                         "<td>"+
                                         "<a href=\"view_comments.php?id="+data.data[i].id+"\">View Comments</a> / "+
                                         "<a href=\"video_watch_time.php?id="+data.data[i].id+"\">Watched By</a> / "+
                                         "<button class=\"btn btn-link p-0\" onclick=\"if(confirm('Do you want to remove video and associated comments ?') == true){location.href='delete_video.php?id="+data.data[i].id+"';}\">Remove</button>"+
                                         "</td>"+
                                         "</tr>";
                            table = table + string;
                        }
                        $("#video_table").html(table);
                    }
                });
            });
        </script>
    </body>
</html>