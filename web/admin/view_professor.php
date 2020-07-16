<?php
    include_once 'validate_admin.php';
    $msg = 0;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $professor = $conn->query("select id,first_name,last_name,class_id,medium_id,mobile,email from login where user_type=1");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Dashboard</title>
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
                <div class="alert alert-primary h6"><?php echo $msg ?></div>
                <?php } ?>

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
                        <tbody>

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
                                    <button class="btn btn-link p-0">Edit <i class="fas fa-pen-square"></i></button> / 
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to remove account of <?php echo $row['first_name'].' '.$row['last_name']; ?> for permanently?')){location.href='remove_professor.php?id=<?php echo $row['id'] ?>';}">Remove <i class="far fa-trash-alt"></i></button>
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
