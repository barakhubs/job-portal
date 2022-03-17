<div class="sidemenu-area">
        <div class="sidemenu-header">
            <a href="/admin" class="navbar-brand d-flex align-items-center">
                <img src="../assets/images/logo.png" alt="image">
            </a>
            <div class="responsive-burger-menu d-block d-lg-none">
                <span class="top-bar"></span>
                <span class="middle-bar"></span>
                <span class="bottom-bar"></span>
            </div>
        </div>
        <div class="sidemenu-body">
            <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
                <li class="nav-item">
                    <a href="/admin/" class="nav-link">
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/jobs.php" class="nav-link">
                        <span class="menu-title">Manage Jobs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/categories.php" class="nav-link">
                        <span class="menu-title">Job Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/applications.php" class="nav-link">
                        <span class="menu-title">All Applicants</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/shortlists.php" class="nav-link">
                        <span class="menu-title">Shortlisted Applicants</span>
                    </a>
                </li>
                <?php 
                if($user['role'] == 'super'){ 
                    ?>
                <li class="nav-item">
                    <a href="/admin/manage-accounts.php" class="nav-link">
                        <span class="menu-title">Manage Accounts</span>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="/admin/profile.php" class="nav-link">
                        <span class="menu-title">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout.php" class="nav-link">
                        <span class="menu-title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>