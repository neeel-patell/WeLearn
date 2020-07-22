<?php
    include_once 'validate_admin.php';
    $medium = $conn->query("select id,name,active from medium");
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Admin - Medium</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">Admin - Medium <i class="fas fa-address-card"></i></h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3" id="content">
                
                <?php if($msg != ""){ ?>
                    <div class="alert alert-primary h6"><?php echo $msg; ?></div>
                <?php } ?>
                
                <form class="card border-success p-3 mb-3" method="post" action="insert_medium.php" data-parsley-validate>
                    <h5 class="text-danger">Add Medium</h5>
                    <label class="label mt-4">Medium Name: <span class="text-danger">*</span></label>
                    <div class="clearfix">
                        <input type="text" name="medium" class="form-control w-75 float-left" id="medium" Placeholder="Enter Medium Name" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-error-message="Name doesn't contain numbers" required maxlength="20">
                        <input type="submit" class="form-control w-25 btn-success" value="Add">
                    </div>
                </form>
                <div class="table-responsive mt-4 card p-3">
                    <h4 class="text-center text-danger mb-3"><u>Available Medium List</u></h4>
                    <table class="table table-hover text-center table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</td>
                                <th>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $sr = 0; while($row = $medium->fetch_array()){ ?>
                            <tr>
                                <th scope="row" style="width:10%"><?php echo ++$sr; ?></td>
                                <td id="td_<?php echo $sr; ?>">
                                    <?php echo $row['name']; ?> &nbsp; &nbsp; 
                                    <button class="btn btn-link p-0" onclick="edit('td_<?php echo $sr; ?>','<?php echo $row['name']; ?>','<?php echo $row['id']; ?>')"><i class="fas fa-pencil-alt"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do You want to remove <?php echo $row['name']; ?> and associated classes and student accounts?')){location.href='remove_medium.php?id=<?php echo $row['id']; ?>'}">Remove</button> / 
                                    
                                    <?php if($row['active'] == 1){ ?>
                                    <button class="btn btn-link p-0" onclick="if(confirm('Do You want to disable <?php echo $row['name']; ?> and associated classes and student accounts?')){location.href='disable_medium.php?id=<?php echo $row['id']; ?>'}">Disable</button>
                                    <?php } else{ ?>
                                        <button class="btn btn-link p-0" onclick="if(confirm('Do You want to enable <?php echo $row['name']; ?> and associated classes and student accounts?')){location.href='enable_medium.php?id=<?php echo $row['id']; ?>'}">Enable</button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
        <script>
            function edit(td_id,medium_name,id){
                var string = '<form class="p-1" method="post" action="update_medium.php" data-parsley-validate>'+
                           '<input type="hidden" name="id" value="'+id+'">'+
                           '<div class="clearfix">'+
                            '<input type="text" name="medium" class="form-control w-75 float-left" id="medium_'+id+'" Placeholder="Enter Medium Name" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-error-message="Name doesn\'t contain numbers" value="'+medium_name+'" required maxlength="20">'+
                            '<input type="submit" class="form-control w-25 btn-success" value="Change">'+
                           '</div>'+
                          '</form>';
                $('#'+td_id).html(string);
                $('#medium_'+id).focus();
            }
        </script>
    </body>
</html>