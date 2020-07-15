<?php
    $msg = 0;
    include_once 'validate_professor.php'; 
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $user_details = $conn->query("SELECT first_name,last_name,gender,mobile,`address`,date_of_birth from `login` where id=$login");
    $user_details = $user_details->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Edit Profile</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-warning">Edit Profile <i class="fas fa-user-alt"></i> <i class="fas fa-edit"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">

                <?php if($msg !== 0){ ?>
                <div class="alert alert-primary text-center h6"><?php echo $msg; ?></div>
                <?php } ?>

                <form class="container p-3 card border-success" action="edit_personal_details.php" method="post" data-parsley-validate refresh()>
                    <h5 class="text-danger">
                        Personal Details : <button type="button" onclick="make_enable()" id="editable_button" class="btn btn-link p-0">Edit</button>
                    </h5>
                    <div class="container-fluid p-2">
                        <label>First Name : </label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $user_details['first_name']; ?>" placeholder="Enter First Name" pattern="/^[A-Za-z ]+$/" data-parsley-error-message="Name can only contain alphabets and 25 character long" maxlength="25" required disabled>
                    </div>
                    <div class="container-fluid p-2">
                        <label>Last Name : </label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $user_details['last_name']; ?>" placeholder="Enter Last Name" pattern="/^[A-Za-z ]+$/" data-parsley-error-message="Name can only contain alphabets and 25 character long" maxlength="25" required disabled>
                    </div>
                    <div class="container-fluid p-2">
                        <label>Mobile : </label>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $user_details['mobile']; ?>" placeholder="Enter Mobile Number" data-parsley-type="digits" data-parsley-error-message="It Should be valid mobile number" data-parsley-length="[10, 10]" required disabled>
                    </div>
                    <div class="container-fluid p-2">
                        <label>Gender : </label>
                        <div class="form-check ml-2">
                            <input type="radio" name="gender" id="rdb_male" value="0" class="form-check-input" <?php if($user_details['gender'] == 0){echo "checked";} ?> required disabled>
                            <label for="rdb_male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check ml-2">
                            <input type="radio" name="gender" id="rdb_female" value="1" class="form-check-input" <?php if($user_details['gender'] == 1){echo "checked";} ?> required disabled>
                            <label for="rdb_female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check ml-2">
                            <input type="radio" name="gender" id="rdb_other" value="2" class="form-check-input" <?php if($user_details['gender'] == 2){echo "checked";} ?> required disabled>
                            <label for="rdb_other" class="form-check-label">Rather not say</label>
                        </div>
                    </div>
                    <div class="container-fluid p-2">
                        <label>Address : </label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php echo $user_details['address']; ?>" placeholder="Enter Address" required disabled>
                    </div>
                    <div class="container-fluid p-2">
                        <label>Date of Birth : </label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php echo date('Y-m-d',strtotime($user_details['date_of_birth'])); ?>" placeholder="Enter Mobile Number" data-parsley-type="digits" data-parsley-length="[10, 10]" required disabled>
                    </div>
                    <div class="container w-75 p-2" id="submit_div"></div>
                </form>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
            function make_enable(){
                document.getElementById('first_name').disabled = false;
                document.getElementById('last_name').disabled = false;
                document.getElementById('mobile').disabled = false;
                document.getElementById('date_of_birth').disabled = false;
                document.getElementById('rdb_male').disabled = false;
                document.getElementById('rdb_female').disabled = false;
                document.getElementById('rdb_other').disabled = false;
                document.getElementById('address').disabled = false;
                document.getElementById('editable_button').disabled = false;
                document.getElementById('editable_button').innerHTML = "";
                document.getElementById('submit_div').innerHTML = '<button type="submit" class="btn-success form-control" id="submit_button" >Update Personal Details</button>';
                document.getElementById('first_name').focus();
            }
        </script>
    </body>
</html>