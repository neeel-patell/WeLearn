<?php
    $msg = 0;
    include_once 'validate_admin.php'; 
    $medium = $conn->query("select id,name from medium");
    $subject = $conn->query("select id,first_name,last_name from login where user_type=1");
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Associate Professor</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-warning container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - Associate Profesor <i class="fas fa-chalkboard-teacher"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0 m-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0 m-0" id="content" style="display :block;">
                <h5 class="bg-primary p-3 text-white text-center">Associate Subject to Professor</h5>
                <div class="container w-75">

                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>

                    <form action="associate_professor_to_subject.php" method="post" data-parsley-validate class="card border-success p-3 m-3">
                        <div class="form-group mt-2">
                            <label class="label">Medium: <span class="text-danger">*</span></label>
                            <select class="form-control" name="medium" id="medium" required>
                                <option value="">- - - Select Medium - - -</option>

                                <?php while($row = $medium->fetch_array()){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="label">Class: <span class="text-danger">*</span></label>
                            <select class="form-control" name="class" id="class" required>
                                <option value="">- - - Select Medium - - -</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="label">Subject: <span class="text-danger">*</span></label>
                            <select class="form-control" name="subject" id="subject" required>
                                <option value="">- - - Select Class - - -</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="label">Professor: <span class="text-danger">*</span></label>
                            <select class="form-control" name="professor" id="professor" required>
                                <option value="">- - - Select Professor - - -</option>

                                <?php while($row = $subject->fetch_array()){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']." ".$row['last_name']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="container w-50 mt-2">
                            <input type="submit" value="Associate to Professor" class="form-control btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script>
            $('#medium').change(function(){
                var medium = $("#medium").val();
                $.ajax({
                    type: 'POST',
                    url: "../api/get_class.php",
                    data: {medium:medium},
                    dataType: "html",
                    success: function(data) {
                        $("#class").html(data);
                    }
                });
            });
            $('#class').change(function(){
                var name = $("#class").val();
                $.ajax({
                    type: 'POST',
                    url: "../api/get_subject.php",
                    data: {class:name},
                    dataType: "html",
                    success: function(data) {
                        $("#subject").html(data);
                    }
                });
            });
        </script>
    </body>
</html>
