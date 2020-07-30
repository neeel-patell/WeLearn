<?php
    include_once 'validate_admin.php';
    $msg = 0;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $blog = $conn->query("SELECT id,subject,created_at from blog order by created_at desc");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Blogs List</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-primary container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - View Blogs <i class="fas fa-blog"></i> </h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content" style="display :block;">

                <?php if($msg != ""){ ?>
                <div class="alert alert-primary h6 text-center"><?php echo $msg ?></div>
                <?php } ?>

                <div class="container">
                    
                    <?php while($row = $blog->fetch_array()){ ?>
                    <div class="card p-3 mt-3 mt-3">
                        <h6 class="text-right"><?php echo date('dS F Y, H:i A',strtotime($row['created_at'])); ?></h6>
                        <button class="btn btn-link mb-3" onclick="location.href='view_blog_details.php?id=<?php echo $row['id']; ?>';"><?php echo $row['subject']; ?></button>
                        <button class="form-control btn-danger" onclick="if(confirm('Do you want to delete blog? ')){location.href='delete_blog.php?id=<?php echo $row['id'] ?>'}">Delete Blog</button>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>