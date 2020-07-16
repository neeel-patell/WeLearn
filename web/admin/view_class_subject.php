<?php
    include_once 'validate_admin.php';
    $class = 0;
    if(isset($_GET['id']) == false){
        header('location: view_class.php');
    }
    else{
        $class = $_GET['id'];
        if($class <= 0){
            header('location: view_class.php');
        }
    }
    $class_details = $conn->query("SELECT name,medium_id from class where id=$class");
    $class_details = $class_details->fetch_array();
    $medium = $conn->query("SELECT name from medium where id=".$class_details['medium_id']);
    $medium = $medium->fetch_array();
    $class_subject = $conn->query("SELECT id,subject_id from class_subject where class_id=$class");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - View Class Subjects</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white"><?php echo $medium['name']." Medium - Class ".$class_details['name']." Subjects"; ?></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                <div class="table-responsive mt-4 card p-3">
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $sr = 1;
                                while($row = $class_subject->fetch_array()){
                                    $subject = $conn->query("SELECT name from subject where id=".$row['subject_id']);
                                    $subject = $subject->fetch_array();
                            ?>
                            <tr>
                                <th><?php echo $sr++; ?></th>
                                <td class="w-50"><?php echo $subject['name']; ?></td>
                                <td>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do You want to delete subject association and its content ?') == true){location.href='remove_subject.php?id=<?php echo $row['id']; ?>&class=<?php echo $class; ?>';}">Remove Asscociation</button>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
            $("#medium_drop").change(function(){
                var medium = $("#medium_drop").val();
                $.ajax({
                    type: 'POST',
                    url: "../api/get_class_data.php",
                    data: {medium:medium},
                    dataType: "text",
                    success: function(data) {
                        data = JSON.parse(data);
                        var table = "";
                        for(var i=0; i<data.data.length; i++){
                            var string = "<tr>"+
                                "<th>"+(i+1)+"</th>"+
                                "<td>"+data.data[i].name+"</td>"+
                                "<td>"+
                                    "<a href='view_class_subject.php?id="+data.data[i].id+"'>View Subjects</a> / "+
                                    "<a href=''>Remove</a>"+
                                "</td>"+
                                "</tr>";
                            table = table + string;
                        }
                        $("#class_table").html(table);
                    }
                });
            });
        </script>
    </body>
</html>