<?php
    session_start();
    $msg = "";
    if(isset($_SESSION['login'])){
        if(isset($_SESSION['user_type'])){
            if($_SESSION['user_type'] == 0){
                header('location: admin/');
            }
            else{
                header('location: professor/');
            }
        }
    }
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Login</title>
        <link rel="stylesheet" href="resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="resources/css/sidebar.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
    </head>
    <body>
        <header class="jumbotron mb-0 p-5" style="min-height: 15vh; background: #371af4;">
            <h4 class="text-white" style="font-family: verdana;"><i class="fas fa-user-graduate"></i> Welearn <i class="fas fa-book"></i></h4>
        </header>
        <div class="container w-50 mt-5 mb-5" style="min-height: 65vh;">
            <div class="card border-dark">
                <div class="container-fluid rounded text-center bg-danger text-white h4 text-monospace p-4 m-0">Login <i class="fas fa-chalkboard-teacher"></i></div>
                <form action="user_login.php" method="post" class="p-3">

                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>
                
                    <div class="form-group mt-2">
                        <label class="label">Email :</label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="256" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class="label">Password :</label>
                        <div class="input-group mb-3">
                            <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password" aria-label="Password" minlength="8" maxlength="32" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" tabindex="-1" type="button" id="show_pass"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="container w-50 mt-5 text-center">
                        <button type="submit" class="form-control btn-success mr-3">Login <i class="fas fa-lock"></i></button>
                    </div>
                </form>
                <div class="container-fluid rounded text-right bg-dark h6 text-monospace p-4 m-0" style="bottom: 0;">
                    <a href="forgot_password.php" class="btn-link text-white">Forgot Password ?</a>
                </div>
            </div>
        </div>
        <footer class="jumbotron p-4 mb-0 bg-info" style="min-height: 10vh;">
            <h5 class="text-right"><i class="fas fa-copyright"></i> Lampros Tech</h5>
        </footer>
        <script src="resources/js/font-awesome.js"></script>
        <script src="resources/js/jquery.min.js"></script>
        <script src="resources/js/popper.min.js"></script>
        <script src="resources/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $("#show_pass").click(function(){
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
