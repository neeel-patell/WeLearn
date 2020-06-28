<?php include_once 'validate_admin.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Dashboard</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white"><i class="fas fa-tachometer-alt"></i> Admin - Dashboard</h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-0" id="content">
                
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>
