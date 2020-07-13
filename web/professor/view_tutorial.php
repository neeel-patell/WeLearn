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
        <title>Welearn - Professor - Tutorial List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Tutorial List <i class="fas fa-file-pdf"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-2">
                <div class="table-responsive p-3">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
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
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <select name="topic" id="topic" class="form-control" required>
                                <option value="" selected>- - - Select Topic - - -</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th class="w-25">Sr. No</th>
                            <th>Video Name</th>
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
                    url: "../api/get_tutorial.php",
                    data: {topic:topic},
                    dataType: "text",
                    success: function(data) {
                        data = JSON.parse(data);
                        for(var i=0; i<data.data.length; i++){
                            var string = "<tr>"+
                                         "<td>"+(i+1)+"</td>"+
                                         "<td>"+data.data[i].name+"</td>"+
                                         "<td>"+"<a href=\"view_tutorial_single.php?id="+data.data[i].id+"\">View</a>"+"</td>"+
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