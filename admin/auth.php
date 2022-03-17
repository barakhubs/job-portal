<?php
    error_reporting(0);
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    function myAutoLoad($class){
        require_once "../config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Authentication Page";
    
    include "partials/head.php";
    
    // check is user already logged in
    
    if(!empty(isset($_SESSION['admin'])) || ($_SESSION['admin'] != "")){
        header('location: /admin/index.php');
        exit;
      }else{

        $func = new functions();
        
        if(isset($_POST['login'])){
            $email = $_POST['email'];

            $password = $_POST['password'];

            $error = "Incorrect login credentials. Please try again!";

            $url = '/admin/auth.php';

            $table = "admins";
            // check if user exists
            // password hash;

            $func = new functions();
            $func->login($email, $password, $table, $url, $error);
            
        }
    }

?>
<body>
    <?php
    // <!-- preloader -->
    include "partials/preloader.php";

    ?>

    <div class="user-area pt-100 pb-70">
        <div class="container pt-5">
            <?php
                if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
            <?php } ?>
            <?php
                if (isset($_GET['msg'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['msg']; ?>
                    </div>
            <?php } ?>
            <div class="row pt-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="user-all-form">
                        <div class="contact-form">
                            <h3> Admin Login</h3>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input required type="text" name="email" id="email" class="form-control" required
                                                data-error="Please enter your Username or Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required class="form-control" type="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <button name="login" type="submit" class="default-btn">
                                            Log In Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    // <!-- scripts -->
    include ("partials/scripts.php");
    ?>
</body>

</html>