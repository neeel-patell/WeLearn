<?php
    include_once 'validate_admin.php';
    $msg = 0;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $student = $conn->query("select id,first_name,last_name,class_id,medium_id,mobile,email,active from login where user_type=2");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Student List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-warning container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - View Student <i class="fas fa-user"></i> </h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content" style="display :block;">

                <?php if($msg != ""){ ?>
                <div class="alert alert-primary h6 text-center"><?php echo $msg ?></div>
                <?php } ?>

                <div class="table-responsive p-3">
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</td>
                                <th>Medium</td>
                                <th>Class</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $sr = 1;
                                while($row = $student->fetch_array()){
                                $class = $conn->query("SELECT name from class where id=".$row['class_id']);
                                $class = $class->fetch_array();
                                $medium = $conn->query("SELECT name from medium where id=".$row['medium_id']);
                                $medium = $medium->fetch_array();
                            ?>
                            <tr>
                                <th><?php echo $sr++; ?></th>
                                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                <td><?php echo $medium['name']; ?></td>
                                <td><?php echo $class['name']; ?></td>
                                <td>
                                    <button class="btn btn-link p-0" onclick="location.href='view_student_details.php?id=<?php echo $row['id']; ?>'">View Full details <i class="fas fa-eye"></i></button> / 
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to remove account of <?php echo $row['first_name'].' '.$row['last_name']; ?> for permanently?')){location.href='remove_student.php?id=<?php echo $row['id'] ?>';}">Remove <i class="far fa-trash-alt"></i></button> /
                                    
                                    <?php if($row['active'] == 1){ ?>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to disable account of <?php echo $row['first_name'].' '.$row['last_name']; ?> ?')){location.href='disable_student.php?id=<?php echo $row['id'] ?>';}">Deactivate Account <i class="fas fa-ban"></i></button>
                                    <?php } else { ?>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to enable account of <?php echo $row['first_name'].' '.$row['last_name']; ?> ?')){location.href='enable_student.php?id=<?php echo $row['id'] ?>';}">Activate Account <i class="fas fa-check"></i></button>
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
    </body>
</html>