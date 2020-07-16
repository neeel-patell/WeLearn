<?php
    include_once 'validate_admin.php';
    $medium = $conn->query("select id,name from medium");
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Add Class</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Admin - Add Class <i class="fas fa-chalkboard"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                
                <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg; ?></div>
                <?php } ?>
                
                <div class="row p-2">
                    <div class="col-md-3"></div>
                    <form class="card border-success p-3 mb-3 col-md-6" method="post" action="insert_class.php" data-parsley-validate>
                        <h5 class="text-danger">Add Class</h5>
                        <div class="form-group mt-2">
                            <label class="label mt-4">Medium Name: <span class="text-danger">*</span></label>
                            <select name="medium" class="form-control" id="medium" required>
                                <option value="">- - - Select Medium - - -</option>
                                <?php while($row = $medium->fetch_array()){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="label">Class Name: <span class="text-danger">*</span></label>
                            <input type="text" name="class" placeholder="Enter Class Name to add to selected medium" class="form-control" id="class" maxlength="20" required>
                        </div>
                        <div class="container w-50 mt-2">
                            <input type="submit" value="Add Class" class="form-control btn-success">
                        </div>
                    </form>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>