<?php
    include_once 'validate_admin.php';
    $medium = $conn->query("select id,name from medium");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - View Class</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Admin - View Class <i class="fas fa-clipboard-list"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                <div class="table-responsive mt-4 card p-3">
                    <div class="clearfix">
                        <h4 class="text-danger float-left w-50"><u>Available Class List</u></h4>
                        <div class="float-right w-50">
                            <select class="form-control mt-3 mb-3" id="medium_drop" required>
                                <option value="">- - - Select Medium to see it's classes - - -</option>
                                <?php
                                    mysqli_data_seek($medium,0);
                                    while($row = $medium->fetch_array()){ 
                                ?>
                                <option value='<?php echo $row['id']; ?>'><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody id="class_table"></tbody>
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