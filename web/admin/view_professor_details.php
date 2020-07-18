<?php 
    include_once 'validate_admin.php';
    $id = 0;
    if(isset($_GET['id']) == false){
        header('location: view_professor.php');
    }
    else{
        $id = $_GET['id'];
        if($id <= 0){
            header('location: view_professor.php');
        }
    }
    $professor_details = $conn->query("SELECT first_name,last_name,gender,email,mobile,`address` from login where id=$id");
    $professor_details = $professor_details->fetch_array();
    $subject_professor = $conn->query("SELECT subject_id from subject_professor where login_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor Details</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="jumbotron bg-success text-white p-5" style="min-height: 10vh;">
            <h4><?php echo $professor_details['first_name']." ".$professor_details['last_name']; ?>'s Details</h4>
        </div>
        <div style="min-height: 80vh;">
            <div class="table-responsive p-3">
                <table class="table table-bordered table-hover">
                    <div class="text-center">
                        <img src="../../images/profile/<?php echo $id; ?>.jpg" alt="Profile Image" class="img-thumbnail" style="width: 20%; border-radius: 50%;">
                    </div>
                    <tbody>
                        <tr>
                            <th class="text-right h5 w-25">Email : </th>
                            <td><a href="mailto:<?php echo $professor_details['email']; ?>"><?php echo $professor_details['email']; ?></a></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Mobile : </th>
                            <td><a href="tel:+91<?php echo $professor_details['mobile']; ?>"><?php echo "(+91) ".$professor_details['mobile']; ?></a></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Gender : </th>
                            <td>
                                <?php 
                                    if($professor_details['gender'] == 0)
                                        echo "Male";
                                    else if($professor_details['gender'] == 1)
                                        echo "Female";
                                    else
                                        echo "Rather not say";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Address : </th>
                            <td><?php echo $professor_details['address']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Associated Subjects : </th>
                            <td>
                                <ul class="m-0">
                                
                                <?php
                                    while($row = $subject_professor->fetch_array()){
                                        $class_subject = $conn->query("SELECT class_id,subject_id from class_subject where id=".$row['subject_id']);
                                        $class_subject = $class_subject->fetch_array();
                                        $class = $conn->query("SELECT name from class where id=".$class_subject['class_id']);
                                        $class = $class->fetch_array();
                                        $subject = $conn->query("SELECT name from `subject` where id=".$class_subject['subject_id']);
                                        $subject = $subject->fetch_array();
                                        echo "<li>Class ".$class['name']." - ".$subject['name']."</li>";
                                ?>
                                <?php } ?>
                                
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>
