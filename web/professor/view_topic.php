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
        <title>Welearn - Professor - Topic List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Topic List <i class="fas fa-edit"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-2">
                <div class="table-responsive p-3">

                    <?php if($msg !== 0){ ?>
                    <div class="alert alert-danger text-center h6"><?php echo $msg; ?></div>
                    <?php } ?>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th class="border-0">
                                <select id="subject_combo" class="form-control">
                                    <option value="">- - - Select Subject - - -</option>
                                
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
                            </th>
                            <th class="border-0"></th>
                        </thead>
                        <thead>
                            <th class="w-25">Sr. No</th>
                            <th>Topic Name</th>
                            <th>Index</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="topic_table"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
            $("#subject_combo").change(function(){
                var subject = $("#subject_combo").val();
                $.ajax({
                    type: 'POST',
                    url: "../api/get_topic.php",
                    data: {subject:subject},
                    dataType: "text",
                    success: function(data) {
                        data = JSON.parse(data);
                        var table = "";
                        for(var i=0; i<data.data.length; i++){
                            var string = "<tr>"+
                                "<th>"+(i+1)+"</th>"+
                                "<td>"+data.data[i].name+"</td>"+
                                "<td>"+((data.data[i].index!=255)?(data.data[i].index):'-')+"</td>"+
                                "<td>"+
                                    '<a class="btn p-0 text-primary btn-link" onclick="return confirmation('+data.data[i].id+',\''+data.data[i].name+'\');">Remove</a>'+
                                "</td>"+
                                "</tr>";
                            table = table + string;
                        }
                        $("#topic_table").html(table);
                    }
                });
            });
            function confirmation(id,name){
                if(confirm("Do you want to delete "+name+" and associated videos?") == true){
                    location.href="remove_topic.php?id="+id;
                }
            }
        </script>
    </body>
</html>