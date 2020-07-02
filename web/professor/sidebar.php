<nav id="sidebar" class="card">
    <div class="mt-3 text-center">
        <img src="../../images/profile/<?php echo $login ?>.jpg" alt="Profile Image" style="vertical-align: middle;width: 50px;height: 50px; border-radius: 50%;">
        <h6 class="mt-3"><?php echo $fullname; ?></h6>
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
            <a class="dropdown-toggle nav-link p-0" data-toggle="collapse" data-target="#area_collapse" role="button" aria-expanded="false">
                Manage Area
            </a>
            <div class="collapse p-2" id="area_collapse">
                <a class="nav-link" href="a.php">Link1</a>
                <a class="nav-link" href="a.php">Link2</a>
                <a class="nav-link" href="a.php">Link3</a>
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