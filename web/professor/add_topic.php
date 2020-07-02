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
        <title>Welearn - Professor - Add Topic</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Add Topic <i class="far fa-edit"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">
                <form action="insert_topic.php" method="post" class="card border-success p-3" data-parsley-validate>
                    
                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>
            
                    <div class="form-group mt-2">
                        <label class="label">Subject: <span class="text-danger">*</span></label>
                        <select class="form-control" name="subject" id="subject" required>
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
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">Topic Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="topic" id="topic" maxlength="40" placeholder="Enter Topic Name" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">At Index:</label>
                        <input type="text" class="form-control" name="index" id="index" maxlength="2" data-parsley-error data-parsley-type="number" placeholder="Enter Index number to place topic there(optional)">
                    </div>
                    <div class="container w-50 mt-2">
                        <input type="submit" value="Add Topic" class="form-control btn-success">
                    </div>
                </form>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>