<nav id="sidebar" class="card">
    <div class="mt-3 text-center">
        <button onclick="location.href='edit_profile_picture.php';" class="btn btn-link text-danger p-0">
            <img src="../../images/profile/<?php echo $login ?>.jpg" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%;">
        </button>
        <h6 class="mt-3"><?php echo $fullname; ?></h6>
        <button class="btn btn-link text-danger" onclick='location.href="edit_profile.php";'>Edit Details <i class="far fa-edit"></i></button>
    </div>
    <ul class="navbar-nav flex-column text-center mt-3" style="font-weight: 500">
        <li class="nav-item border-top">
            <a href="index.php" class="nav-link text-secondary">Home <i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item border-top">
            <a href="associated_subject.php" class="nav-link text-info">Associated Subjects <i class="fas fa-book"></i></a>
        </li>
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link p-0 text-primary" data-toggle="collapse" data-target="#topic_collapse" role="button" aria-expanded="false">
                Manage Topic
            </a>
            <div class="collapse p-2" id="topic_collapse">
                <a class="nav-link" href="add_topic.php">Add Topic</a>
                <a class="nav-link" href="view_topic.php">View Topic</a>
            </div>
        </li>
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link p-0 text-primary" data-toggle="collapse" data-target="#video_collapse" role="button" aria-expanded="false">
                Manage Video
            </a>
            <div class="collapse p-2" id="video_collapse">
                <a class="nav-link" href="add_video.php">Add Video</a>
                <a class="nav-link" href="view_video.php">View Videos</a>
            </div>
        </li>
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link p-0 text-primary" data-toggle="collapse" data-target="#tutorial_collapse" role="button" aria-expanded="false">
                Manage Tutorials
            </a>
            <div class="collapse p-2" id="tutorial_collapse">
                <a class="nav-link" href="add_tutorial.php">Add Tutorial</a>
                <a class="nav-link" href="view_tutorial.php">View Tutorial</a>
            </div>
        </li>
        <li class="nav-item border-top">
            <a href="change_password.php" class="nav-link text-danger">Change Password</a>
        </li>
        <li class="nav-item border-top border-bottom">
            <a href="../logout.php" class="nav-link text-danger">Logout</a>
        </li>
    </ul>
</nav>