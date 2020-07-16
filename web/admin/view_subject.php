<?php
    include_once 'validate_admin.php';
    $subject = $conn->query("select id,name from subject");
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - View Subject</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Admin - View Subject <i class="fas fa-book"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                
                <?php if($msg != ""){ ?>
                <div class="alert alert-primary text-center h6"><?php echo $msg; ?></div>
                <?php } ?>
                
                <form class="card border-success p-3 mb-3" method="post" action="insert_subject.php" data-parsley-validate>
                    <h5 class="text-danger">Add Subject</h5>
                    <label class="label mt-4">Subject Name: <span class="text-danger">*</span></label>
                    <div class="clearfix">
                        <input type="text" name="subject" class="form-control mb-3" id="subject" Placeholder="Enter Subject Name" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-error-message="Name doesn't contain numbers" required maxlength="30">
                        <input type="submit" class="btn btn-success" value="Add Subject">
                    </div>
                </form>
                <div class="table-responsive mt-4 card p-3">
                    <h4 class="text-danger mb-3"><u>Available Subject List</u></h4>
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody id="class_table">
                            
                            <?php $sr=1; while($row = $subject->fetch_array()){ ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <button class="btn btn-link p-0" onclick="location.href='edit_subject.php?id=<?php echo $row['id']; ?>';">Edit</button> /
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do you want to remove <?php echo $row['name']; ?> ?') == true){location.href='remove_main_subject.php?id=<?php echo $row['id']; ?>';}">Remove</button>
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