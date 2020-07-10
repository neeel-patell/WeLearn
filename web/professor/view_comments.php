<?php
    $msg = "";
    $comment = 0;
    include_once 'validate_professor.php'; 
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    if(isset($_GET['id']) == true){
        $video = $_GET['id'];
    }
    else{
        header('location: view_video.php');
    }
    $comments = $conn->query("SELECT description,id,user_id from video_comment where video_id=$video order by id desc");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welearn - Professor - Video Comments</title>
        <?php include_once 'css_files.php' ?>
    </head>
    <body>
        <div class="bg-dark container-fluid p-3 pl-5" style="min-height: 10vh;">
            <h4 class="text-white">
                <?php 
                    $video_show = $conn->query("SELECT name from video where id=$video");
                    $video_show = $video_show->fetch_array();
                    echo $video_show['name']." Comments ";
                ?>
                <i class="fas fa-comments"></i>
            </h4>
            <button type="button" id="sidebarCollapse"  class="btn btn-outline-light mr-2 mt-2"><i class="fas fa-grip-lines"></i></button>
        </div>
        <div class="d-flex p-0" style="min-height: 80vh;">
            <?php include_once 'sidebar.php' ?>
            <div class="container-fluid p-3">
                
                <?php if($msg != ""){ ?>
                <div class="alert alert-warning text-center h6"><?php echo $msg; ?></div>
                <?php } ?>

                <?php 
                    $sr=1;
                    while($row = $comments->fetch_array()){
                        $user = $conn->query("SELECT first_name,last_name from login where id=".$row['user_id']);
                        $user = $user->fetch_array();
                ?>
                <div class="card mt-3 mb-3 p-3" id="comment_div_<?php echo $sr; ?>">
                    <div class="row">
                        <h5 class="col-md-9"><?php echo $sr++.". ".$user['first_name']." ".$user['last_name']; ?></h5>
                        <p class="col-md-3 text-right">
                            <button class="btn link text-danger" onclick="if(confirm('Do you want to delete selected comment and it\'s associated replies?')){location.href='remove_comment.php?comment=<?php echo $row['id']; ?>&video=<?php echo $video; ?>';}">Delete Comment <i class="fas fa-trash-alt"></i></button>
                        </p>
                    </div>
                    <p><?php echo $row['description']; ?></p>
                    <form action="insert_reply.php" method="post">
                        <input type="hidden" name="comment" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="video" value="<?php echo $video; ?>">
                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control" placeholder="Write Reply for comment" name="reply" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="form-control btn-success">Add Reply <i class="fas fa-reply"></i></button>
                            </div>
                        </div>
                    </form>                   
                    <div>
                        <button class="btn link" id="show_reply_button_<?php echo $sr; ?>" onclick="get_replies(<?php echo $sr; ?>,<?php echo $row['id']; ?>)">Show Replies <i class="fas fa-plus"></i></button>
                        <button class="btn link" id="hide_reply_button_<?php echo $sr; ?>" onclick="hide_replies(<?php echo $sr; ?>)" style="display: none;">Hide Replies <i class="fas fa-minus"></i></button>
                    </div>
                    <div class="p-3" id="reply_div_<?php echo $sr; ?>" style="display: none;">
                        
                    </div>
                </div>
                <?php } ?>
            
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
        <script>
            function get_replies(sr,comment){
                $.ajax({
                    type : "POST",
                    url : "../api/view_comment_reply.php",
                    dataType : "text",
                    data : {comment:comment},
                    success : function(data){
                        document.getElementById("reply_div_"+sr).style.display = "block";
                        document.getElementById("show_reply_button_"+sr).style.display = "none";
                        document.getElementById("hide_reply_button_"+sr).style.display = "block";
                        data = JSON.parse(data);
                        var print_string="";
                        for(var i=0 ; i<data.data.length ; i++){
                            var div_data = "<div class=\"card p-2 mb-1\">"+
                                           "<h6>"+(i+1)+". "+data.data[i].name+"</h6>"+
                                           "<p>"+data.data[i].description+"</p>"+
                                           "<p class=\"text-right\"><button class=\"btn link\" onclick=\"if(confirm('Do You Want to Delete this reply') == true){location.href=\'remove_reply.php?reply="+data.data[i].id+"&video=<?php echo $video; ?>\';}\">Delete Reply</button></p>"+
                                           "</div>";
                            print_string += div_data;
                        }
                        $("#reply_div_"+sr).html(print_string);
                    }
                });
            }
            function hide_replies(sr){
                document.getElementById("reply_div_"+sr).style.display = "none";
                document.getElementById("show_reply_button_"+sr).style.display = "block";
                document.getElementById("hide_reply_button_"+sr).style.display = "none";
            }
        </script>
    </body>
</html>