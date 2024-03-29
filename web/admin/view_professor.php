<?php
    include_once 'validate_admin.php';
    $msg = 0;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $professor = $conn->query("select id,first_name,last_name,class_id,medium_id,mobile,email,active from login where user_type=1");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Professor List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-warning container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - View Professor <i class="fas fa-chalkboard-teacher"></i> </h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content" style="display :block;">

                <?php if($msg != ""){ ?>
                <div class="alert alert-primary h6 text-center"><?php echo $msg ?></div>
                <?php } ?>

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <input type="search" class="form-control" id="search_textbox" placeholder="Search Student by email, mobile or name">
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</td>
                                <th>Mobile</td>
                                <th>Email</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody id="search_table">

                            <?php
                                $sr = 1;
                                while($row = $professor->fetch_array()){
                            ?>
                            <tr>
                                <th><?php echo $sr++; ?></th>
                                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                <td><a href="tel:<?php echo $row['mobile']; ?>"><?php echo $row['mobile']; ?></a></td>
                                <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
                                <td>
                                    <button class="btn btn-link p-0" onclick="location.href='view_professor_details.php?id=<?php echo $row['id']; ?>'">View Full details <i class="fas fa-eye"></i></button> / 
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to remove account of <?php echo $row['first_name'].' '.$row['last_name']; ?> for permanently?')){location.href='remove_professor.php?id=<?php echo $row['id'] ?>';}">Remove <i class="far fa-trash-alt"></i></button> /
                                    
                                    <?php if($row['active'] == 1){ ?>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to disable account of <?php echo $row['first_name'].' '.$row['last_name']; ?> ?')){location.href='disable_professor.php?id=<?php echo $row['id'] ?>';}">Deactivate Account <i class="fas fa-ban"></i></button>
                                    <?php } else { ?>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to enable account of <?php echo $row['first_name'].' '.$row['last_name']; ?> ?')){location.href='enable_professor.php?id=<?php echo $row['id'] ?>';}">Activate Account <i class="fas fa-check"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script>
            $("#search_textbox").change(function(){
                var value = $("#search_textbox").val();
                if(value != ""){
                    $.ajax({
                        type : "POST",
                        url : "../api/search_user.php",
                        data : {search : value, user_type : 1},
                        dataType : "html",
                        success : function(data){
                            data = JSON.parse(data);
                            var table = "";
                            for(var i=0 ; i<data.data.length ; i++){
                                var string = "<tr>"+
                                            "<td>"+(i+1)+"</td>"+
                                            "<td>"+data.data[i].first_name+" "+data.data[i].last_name+"</td>"+
                                            "<td>"+data.data[i].medium+"</td>"+
                                            "<td>"+data.data[i].class+"</td>"+
                                            "<td>"+
                                            "<button class='btn btn-link p-0' onclick=\"location.href='view_student_details.php?id="+data.data[i].id+"'\">View Full details <i class='fas fa-eye'></i></button> / "+
                                            "<button class='btn btn-link p-0' onclick=\"if(confirm('Do you want to remove account of "+data.data[i].first_name+" "+data.data[i].last_name+" for permanently?')){location.href='remove_student.php?id="+data.data[i].id+"';}\">Remove <i class='far fa-trash-alt'></i></button> /";
                                if(data.data[i].active == 1){
                                    string = string + "<button class='btn btn-link p-0' onclick=\"if(confirm('Do you want to disable account of "+data.data[i].first_name+" "+data.data[i].last_name+" ?')){location.href='disable_student.php?id="+data.data[i].id+"';}\">Deactivate Account <i class='fas fa-ban'></i></button>";
                                }
                                else{
                                    string = string + "<button class='btn btn-link p-0' onclick=\"if(confirm('Do you want to disable account of "+data.data[i].first_name+" "+data.data[i].last_name+" ?')){location.href='enable_student.php?id="+data.data[i].id+"';}\">Activate Account <i class='fas fa-check'></i></button>";
                                }
                                table = table + string + "</td></tr>";
                            }
                            $("#search_table").html(table);
                        }
                    });
                }
                else{
                    location.reload(true);
                }
            });
        </script>
    </body>
</html>