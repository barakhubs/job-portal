<?php
    session_start();
    function myAutoLoad($class){
        require_once "../config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $func = new functions();
    
    $page_title = "Job Portal Profile";

    include "partials/head.php";

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
      if (isset($_SESSION['id']) || ($_SESSION['id'] != "")) {
        $auth = $_SESSION['id'];
    }else{
        header('location:auth.php');
        exit();
    }
    
    
    
    $user = $func->selectSingle($auth, 'admins');
    
    if (isset($_POST['submit'])) {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $old_pw = $_POST['old_password'];
        $new_pw = $_POST['new_password'];
        $conf_pw = $_POST['confirm_password'];
    
        if($old_pw != "" || $new_pw != "" || $conf_pw !=""){
            if (strlen($new_pw)<6) {
                header("Location:admin/profile.php?error=Password to short! Try again");
    
                exit();
            }elseif($new_pw === $conf_pw){
                if (!password_verify($old_pw, $user['password'])) {
                    header("Location:/admin/profile.php?error=Password does not match old password! Try again");
    
                    exit();
                }else{
                    $fields = [
                        'first_name'  => $fname,
                        'last_name'   => $lname,
                        'phone' => $phone,
                        'email' => $email,
                        'password' => password_hash($new_pw, PASSWORD_DEFAULT),
                        'updated_at' => time()
                    ];
            
                    $error = "An error ocurred when creating job. Please try again!";
                    $msg = "Successfully Updated Profile.";
                    $url = '/admin/profile.php';
                    $table = 'candidates';
                    $id = $user['id'];
            
                    $func->update($fields, $id, $table, $url);
                }
            }else{
                header("Location:/admin/profile.php?error=Passwords do not match! Try again");
    
                exit();
            }
        }else{
            $fields = [
                'first_name'  => $fname,
                'last_name'   => $lname,
                'phone' => $phone,
                'email' => $email,
                'updated_at' => time()
            ];
    
            $error = "An error ocurred when creating job. Please try again!";
            $msg = "Successfully Updated Profile.";
            $url = '/admin/profile.php';
            $table = 'candidates';
            $id = $user['id'];
    
            $func->update($fields, $id, $table, $url);
        }
    
    }
    
    ?>
    
    <body>
    
    
        <?php
        // include('partials/preloader.php') 
        ?>
    
        <?php include('partials/sidebar.php') ?>
        <div class="main-dashboard-content d-flex flex-column">
    
            <!-- nav -->
            <?php include('partials/nav.php') ?>
    
    
            <div class="breadcrumb-area">
                <h1>My Profile</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="/candidate-dashboard.php">Home</a></li>
                    <li class="item">My Profile</li>
                </ol>
            </div>
    
    
            <div class="my-profile-box">
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
                <h3>Profile Details</h3>
                <div class="profile-outer-area-two">
                    <div class="profile-outer">
                        <div class="text-title">
                            <h3><?= $user['first_name'].' ' .$user['last_name']; ?></h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien, felis in dis dui.
                                Feugiat cras orci enim porttitor egestas pellentesque et. Egestas morbi sed mi pulvinar
                                lorem some text tempus.
                            </p>
                        </div>
                    </div>
                </div>
                <form method="post">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>First Name </label>
                                <input type="text" class="form-control" name="first_name" value="<?= $user['first_name']; ?>" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?= $user['last_name']; ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" readonly name="email" value="<?=$user['email']; ?>" class="form-control" placeholder="Email address">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="<?=$user['phone']; ?>" class="form-control" placeholder="+88 (123) 123456">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Member Since</label>
                                <input type="text" readonly class="form-control" value="<?=date('M d, Y', strtotime($user['created_at'])); ?>" placeholder="12.08.2021">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 pb-3 mb-3">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Change Password?
                            </button>
                            <div class="collapse p-2" id="collapseExample">
                                <div class="form-group col-md-6">
                                    <label>Old Password</label>
                                    <input type="text" class="form-control" placeholder="Old Password" name="old_password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>New Password</label>
                                    <input type="text" class="form-control" placeholder="New Password" name="new_password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="text" class="form-control" placeholder="Confirm Password" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <button type="submit" name="submit" class="default-btn">Submit Now <i class="flaticon-send"></i></button>
                        </div>
                    </div>
                </form>
            </div>


        <!-- footer -->
        <?php include('partials/footer.php') ?>

    </div>

    <!-- scripts -->
    <?php include('partials/scripts.php') ?>
</body>

</html>