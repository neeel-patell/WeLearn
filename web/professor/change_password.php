<?php
    include_once 'validate_professor.php'; 
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Change Password</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white text-center">Change Password <i class="fas fa-user-alt"></i> <i class="fas fa-key fa-rotate-90"></i></h4>
            <button type="button" id="sidebarCollapse" class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0" id="content" style="display :block; min-height: 80vh;">
                <div class="container w-75">
                    <form action="update_password.php" method="post" class="card p-4 mt-5">
                    
                        <?php if($msg != ""){ ?>
                            <div class="alert alert-dark h6"><?php echo $msg; ?></div>
                        <?php } ?>
                        
                        <div class="form-group mt-2">
                            <label class="label">New Password :</label>
                            <div class="input-group mb-3">
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter New Password" aria-label="Password" minlength="8" maxlength="32" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" tabindex="-1" id="show_pass"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label class="label">Confirm Password :</label>
                            <div class="input-group mb-3">
                                <input type="password" id="con_pass" name="con_pass" class="form-control" placeholder="Enter Confirm Password" aria-label="Password" minlength="8" maxlength="32" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" tabindex="-1" id="show_con_pass"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
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
            $('#show_con_pass').click(function(){
                if($('#con_pass').attr('type') === "password"){
                    $('#con_pass').attr('type','text');
                    $('#show_con_pass').html("<i class='fas fa-eye-slash'></i>");
                }
                else{
                    $('#con_pass').attr('type','password');
                    $('#show_con_pass').html("<i class='fas fa-eye'></i>");
                }
            });
        </script>
    </body>
</html>
