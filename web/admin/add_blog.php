<?php
    $msg = 0;
    include_once 'validate_admin.php'; 
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Add Blog</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-warning container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - Add Blog <i class="fas fa-edit"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0 m-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0 m-0" id="content" style="display :block;">
                <div class="container">

                    <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg ?></div>
                    <?php } ?>

                    <form action="insert_blog.php" method="post" class="border border-success p-3 m-3"id="professor_form">
                        <div class="form-group mt-3">
                            <label class="label">Subject: <span class="text-danger">*</span></label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject of blog" maxlength="" required autofocus>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label">Description: <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" style="min-height: 50vh;"></textarea>
                        </div>
                        <div class="container w-50 mt-4">
                            <button class="form-control btn-success"><i class="fas fa-plus"></i> Add Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#description' )    )
                .catch( error => {
                    console.error( error );
            });
        </script>
    </body>
</html>
