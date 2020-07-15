<?php
    $msg = 0;
    include_once 'validate_professor.php'; 
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Edit Profile Picture</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-warning">Edit Profile Picture <i class="far fa-user-circle"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">

                <?php if($msg !== 0){ ?>
                <div class="alert alert-primary text-center h6"><?php echo $msg; ?></div>
                <?php } ?>
                
                <form action="change_profile_picture.php" method="POST" class="text-center" enctype="multipart/form-data">
                    <input type='file' style="opacity: 0;" name="profile_picture" id="profile_select" onchange="view_image(this)"/>
                    <div class="p-3">
                        <label for="profile_select"><img src="../../images/profile/<?php echo $login ?>.jpg" style="width: 40%;" id="picture" alt="Profile Picture"></label>
                        <p class="text-danger">* Click on image to select profile picture and upload</p>
                    </div>
                    <button type="submit" class="btn btn-success" style="display: none;" id="btn_upload"><i class="fas fa-upload"></i> Upload</button>
                </form>
            </div>

        </div>
        <?php include_once 'footer.php' ?>
        <script type="text/javascript">
            function view_image(input) {
                if(input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#btn_upload").css("display","block");
                        $('#picture').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </body>
</html>