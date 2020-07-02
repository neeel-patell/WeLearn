<?php
    include_once 'validate_professor.php';
    $associated_subjects = $conn->query("SELECT subject_id from subject_professor where login_id=$login");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Associated Subjects</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Associated Subjects <i class="fas fa-book"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0">
                <div class="table-responsive mt-4 card p-3">
                    <h4 class="text-danger mb-3"><u>Available Subject List</u></h4>
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Class</td>
                                <th>Subject</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $sr=1;
                                while($row = $associated_subjects->fetch_array()){ 
                                    $class_subject = $conn->query("SELECT class_id,subject_id from class_subject where id=".$row['subject_id']);
                                    $class_subject = $class_subject->fetch_array();
                                    $subject = $conn->query("SELECT `name` from `subject` where id=".$class_subject['subject_id']);
                                    $subject = $subject->fetch_array();
                                    $class = $conn->query("SELECT `name` from `class` where id=".$class_subject['class_id']);
                                    $class = $class->fetch_array();
                            ?>
                            <tr>
                                <th><?php echo $sr++; ?></td>
                                <td><?php echo $class['name']; ?></td>
                                <td><?php echo $subject['name']; ?></td>
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