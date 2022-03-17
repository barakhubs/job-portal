<div class="sidemenu-area">
    <div class="sidemenu-header">
        <a href="candidates-dashboard.html" class="navbar-brand d-flex align-items-center">
            <img src="assets/images/logo.png" alt="image">
        </a>
        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>
    </div>
    <?php $func = new functions(); ?>
    <div class="sidemenu-body">
        <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
            <li class="nav-item">
                <a href="candidate-dashboard.php" class="nav-link <?php $func->activePage('candidate-dashboard.php');?>">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/shortlists.php" class="nav-link <?php $func->activePage('shortlists.php');?>">
                    <span class="menu-title">Shortlisted Jobs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/profile.php" class="nav-link <?php $func->activePage('profile.php');?>">
                    <span class="menu-title">View Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <span class="menu-title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>