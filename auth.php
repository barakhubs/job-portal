<!-- head -->
<?php
    error_reporting(0);
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Login/Register";
    
    include "partials/head.php";
    
    // check is user already logged in
    if(isset($_SESSION['candidate']) || ($_SESSION['candidate'] != "")){
        header('location: index.php');
        exit;
      }else{
        $func = new functions();

        $page_title = "Login/Register";


        // Register code
        if (isset($_POST['register'])) {
            $first_name = $_POST['first_name'];

            $last_name = $_POST['last_name'];

            $phone = $_POST['phone'];

            $email = $_POST['email'];

            $password = $_POST['password'];

            $confirm_password = $_POST['confirm_password'];

            // check if email exits
            $check = $func->userExists($email, 'candidates');

            if ($check) {
                header("Location:auth.php?error=User exits! Please log to your account");

                exit();
            }
            // validate form

            if (strlen($phone) < 9) {
                header("Location:auth.php?error=Phone Number is Invalid. Should be at least 10 digits!");

                exit();
            }elseif(strlen($password) < 6) {
                header("Location:auth.php?error=Password too weak! Should be at least 6 characters");

                exit();
            }elseif ($password === $confirm_password) {
                // table name
                $table = 'candidates';
                // Hash password
                $password = password_hash($password, PASSWORD_DEFAULT);

                $fields = [
                    'first_name'  => $first_name,
                    'last_name'   => $last_name,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => $password
                ];
                $error = "An error ocurred during your registration. Please try again!";
                $msg = "Successfully Created Account. You can now login";
                $url = 'auth.php';

                $func->insert($fields, $table, $msg,$url,$error);
                
            }else{
                header("Location:auth.php?error=Password do not match! Try again");

                exit();
            }     


        }elseif(isset($_POST['login'])){
            $email = $_POST['email'];

            $password = $_POST['password'];

            $error = "Incorrect login credentials. Please try again!";

            $url = 'auth.php';

            $table = "candidates";
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

    // <!-- navbar -->
    include "partials/navbar.php";

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
            <div class="row pt-5">
                <div class="col-lg-6">
                    <div class="user-all-form">
                        <div class="contact-form">
                            <h3> Log In Now</h3>
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
                <div class="col-lg-6">
                    <div class="user-all-form">
                        <div class="contact-form">
                            <h3> Create Account </h3>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your First Name</label>
                                            <input required type="text" class="form-control" required
                                                data-error="Please Enter Your First Name" name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your Last Name</label>
                                            <input required type="text" class="form-control" required
                                                data-error="Please Enter Your Last Name" name="last_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your Phone Number</label>
                                            <input required type="text" class="form-control" required
                                                data-error="Please Enter Your Phone Number" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input required type="email" class="form-control" required
                                                data-error="Please enter Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required class="form-control" type="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input required class="form-control" type="password" name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <button name="register" type="submit" class="default-btn">
                                            Register Now
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
    // <!-- footer -->
    include ("partials/footer.php");


    // <!-- scripts -->
    include ("partials/scripts.php");
    ?>
</body>

</html>