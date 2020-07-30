<?php
    include_once 'validate_admin.php';
    $blog = $conn->query("SELECT id,subject,description from blog where id=".$_GET['id']);
    $blog = $blog->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Blog</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-primary container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-dark">Admin - Read Blog Content</h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                <div class="container card p-0">
                    <h5 class="bg-warning jumbotron p-4 text-center"><?php echo $blog['subject']; ?></h5>
                    <div class="p-3">
                        <?php echo $blog['description']; ?>
                    </div>
                </div>
                <div class="container mt-5 mb-3">
                    <button class="form-control btn-danger" onclick="if(confirm('Do you want to delete blog ? ')){location.href='delete_blog.php?id=<?php echo $blog['id'] ?>'}">Delete Blog</button>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
    </body>
</html>