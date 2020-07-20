<?php 
    include_once 'validate_admin.php';
    $id = 0;
    if(isset($_GET['id']) == false){
        header('location: view_student.php');
    }
    else{
        $id = $_GET['id'];
        if($id <= 0){
            header('location: view_student.php');
        }
    }
    $student_details = $conn->query("SELECT first_name,last_name,gender,mobile,email,class_id,medium_id,address from login where id=$id");
    $student_details = $student_details->fetch_array();
    $class = $conn->query("SELECT name from class where id=".$student_details['class_id']);
    $class = $class->fetch_array();
    $medium = $conn->query("SELECT name from medium where id=".$student_details['medium_id']);
    $medium = $medium->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Student Details</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="jumbotron bg-success text-white p-5" style="min-height: 10vh;">
            <h4><?php echo $student_details['first_name']." ".$student_details['last_name']; ?>'s Details</h4>
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
                            <td><a href="mailto:<?php echo $student_details['email']; ?>"><?php echo $student_details['email']; ?></a></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Mobile : </th>
                            <td><a href="tel:+91<?php echo $student_details['mobile']; ?>"><?php echo "(+91) ".$student_details['mobile']; ?></a></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Medium : </th>
                            <td><?php echo $medium['name'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Class : </th>
                            <td><?php echo $class['name'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Gender : </th>
                            <td>
                                <?php 
                                    if($student_details['gender'] == 0)
                                        echo "Male";
                                    else if($student_details['gender'] == 1)
                                        echo "Female";
                                    else
                                        echo "Rather not say";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right h5 w-25">Address : </th>
                            <td><?php echo $student_details['address']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>
