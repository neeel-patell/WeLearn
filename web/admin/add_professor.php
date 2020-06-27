<?php
    $msg = 0;
    include_once 'validate_admin.php'; 
    $medium = $conn->query("select id,name from medium");
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Add Professor</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-warning container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - Add Professor <i class="fas fa-chalkboard-teacher"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0 m-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0 m-0" id="content" style="display :block;">
                <h5 class="bg-primary p-3 text-white text-center">Add Professor</h5>
                <div class="container w-75">

                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>

                    <form action="insert_professor.php" method="post" class="border border-success p-3 m-3" enctype="multipart/form-data" id="professor_form">
                        <div class="form-group mt-3">
                            <label class="label">First Name: <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" data-parsley-pattern="^[a-zA-Z ]+$" id="first_name" data-parsley-error-message="Name doesn't contain numbers" placeholder="Enter First Name" class="form-control" max-length="25" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-error-message="Name doesn't contain numbers" placeholder="Enter Last Name" class="form-control" max-length="25" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Email: <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"  placeholder="someone@example.com" maxlength="256" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Mobile: <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="moblie" class="form-control" data-parsley-error-message="It should be valid mobile number" placeholder="Enter Mobile Number" data-parsley-type="digits" minlength="10" maxlength="10" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Password: <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password" aria-label="Password" minlength="8" maxlength="24" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" tabindex="-1" id="show_pass"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Gender: <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input type="radio" name="gender" id="male" class="form-check-input" value="0">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="female" class="form-check-input" value="1">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="other" class="form-check-input" value="2">
                                <label class="form-check-label" for="other">Rather not Say</label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Address: <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control"  placeholder="Enter Full Address" maxlength="100" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Date of Birth(DD/MM/YYYY): <span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="dob" data-parsley-error-message="Professor must be 16 years older" placeholder="DD/MM/YYYY" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Medium: <span class="text-danger">*</span></label>
                            <select name="medium" id="medium" class="form-control" required>
                                <option value="">- - - Select Medium associated to Professor</option>
                                
                                <?php while($row = $medium->fetch_array()){ ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                <?php } ?>
                            
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Class: <span class="text-danger">*</span></label>
                            <select name="class" id="class" class="form-control" required>
                                <option value="">- - - Select Meduim first - - -</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Image: <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        </div>
                        <div class="container w-50 mt-4">
                            <button class="form-control btn-success"><i class="fas fa-plus"></i> Add Professor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script>
            $('#professor_form').parsley();
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1;
            var yyyy = today.getFullYear()-16;
            if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 
            today = yyyy+'-'+mm+'-'+dd;
            document.getElementById("dob").setAttribute("max", today);
            $('#medium').change(function(){
                var medium = $("#medium").val();
                $.ajax({
                    type: 'POST',
                    url: "get_class.php",
                    data: {medium:medium},
                    dataType: "html",
                    success: function(data) {
                        $("#class").html(data);
                    }
                });
            });
            $('#show_pass').click(function(){
                if($('#pass').attr('type') === "password"){
                    $('#pass').attr('type','text');
                    $('#show_pass').html("<i class='fas fa-eye-slash'></i>");
                }
                else{
                    $('#pass').attr('type','password');
                    $('#show_pass').html("<i class='fas fa-eye'></i>");
                }
            });
        </script>
    </body>
</html>
