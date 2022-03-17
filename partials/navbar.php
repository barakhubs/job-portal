<div class="navbar-area">
        <div class="mobile-responsive-nav">
            <div class="container-fluid">
                <div class="mobile-responsive-menu">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/images/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="desktop-nav desktop-nav-one nav-area">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="/">
                        <img src="assets/images/logo.png" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link active">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/jobs.php" class="nav-link">
                                    Jobs
                                </a>
                            </li>
                        </ul>
                        <?php
                            if(!isset($_SESSION['candidate']) || empty($_SESSION['candidate'])){
                            ?>
                            <div class="others-options d-flex align-items-center">
                                <div class="optional-item">
                                    <a href="auth.php" class="default-btn two border-radius-5">
                                        Login/Register
                                    </a>
                                </div>
                            </div>
                        <?php }else { ?>
                            <div class="others-options d-flex align-items-center">
                                <div class="optional-item">
                                    <a href="candidate-dashboard.php" class="default-btn two border-radius-5">
                                        Account
                                    </a>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </nav>
            </div>
        </div>
        <div class="side-nav-responsive">
            <div class="container-max">
                <div class="dot-menu">
                    <div class="circle-inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="side-nav-inner">
                        <div class="side-nav justify-content-center align-items-center">
                            <div class="side-nav-item">
                                <a href="auth.php" class="default-btn two">
                                    Login / Register <i class="ri-user-3-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>