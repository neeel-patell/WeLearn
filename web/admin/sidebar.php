<nav id="sidebar" class="card">
    <div class="mt-3 text-center">
        <img src="../../images/profile/<?php echo $login ?>.jpg" alt="Profile Image" style="vertical-align: middle;width: 50px;height: 50px; border-radius: 50%;">
        <h6 class="mt-3"><?php echo $fullname; ?></h6>
    </div>
    <ul class="navbar-nav flex-column text-center mt-3" style="font-weight: 500">
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link text-primary p-0" data-toggle="collapse" data-target="#professor_collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                Manage Professor
            </a>
            <div class="collapse p-2" id="professor_collapse">
                <a class="nav-link" href="add_professor.php">Add Professor</a>
                <a class="nav-link" href="view_professor.php">View Professor</a>
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