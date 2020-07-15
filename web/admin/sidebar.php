<nav id="sidebar" class="card">
    <div class="mt-3 text-center">
        <button onclick="location.href='edit_profile_picture.php';" class="btn btn-link text-danger p-0">
            <img src="../../images/profile/<?php echo $login ?>.jpg" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%;">
        </button>
        <h6 class="mt-3"><?php echo $fullname; ?></h6>
    </div>
    <ul class="navbar-nav flex-column text-center mt-3" style="font-weight: 500">
        <li class="nav-item border-top">
            <a href="index.php" class="nav-link text-secondary">Home <i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item border-top">
            <a href="show_medium.php" class="nav-link text-info">View Medium <i class="far fa-address-card"></i></a>
        </li>
        <li class="nav-item border-top">
            <a href="view_class.php" class="nav-link text-info">View Class <i class="fas fa-chalkboard"></i></a>
        </li>
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link text-primary p-0" data-toggle="collapse" data-target="#subject_collapse" role="button" aria-expanded="false">
                Manage Subject <i class="fas fa-book"></i>
            </a>
            <div class="collapse p-2" id="subject_collapse">
                <a class="nav-link" href="view_subject.php">View Subject</a>
                <a class="nav-link" href="associate_subject.php">Associate Subject</a>
            </div>
        </li>
        <li class="nav-item dropdown border-top p-2">
            <a class="dropdown-toggle nav-link text-primary p-0" data-toggle="collapse" data-target="#professor_collapse" role="button" aria-expanded="false">
                Manage Professor
            </a>
            <div class="collapse p-2" id="professor_collapse">
                <a class="nav-link" href="add_professor.php">Add Professor</a>
                <a class="nav-link" href="view_professor.php">View Professor</a>
                <a class="nav-link" href="associate_professor.php">Associate Professor</a>
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