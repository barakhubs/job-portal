<?php
    error_reporting(0);
    session_start();
    function myAutoLoad($class){
        require_once "../config/$class.php";
    }

    spl_autoload_register('myAutoLoad');
    
    $func = new functions();

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
    if(!isset($_SESSION['id']) || ($_SESSION['adidmin'] == "")){
        $admin = $_SESSION['id'];
      }

    $page_title = "Manage Users";

    include "partials/head.php";

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $role = $_POST['role'];
        $pw = $_POST['pw'];
        $cpw = $_POST['conf_pw'];
        if ($email == "" || $role == "" || $pw == "" || $cpw == "") {
            header("Location:/admin/manage-accounts.php?error=Some values are empty! Please try again");    
            exit();
        }
        // check if email exits
        $check = $func->userExists($email, 'admins');

        if ($check) {
            header("Location:/admin/manage-accounts.php?error=User exits! Please Change email address");
            exit();
        }else{
            if ($pw === $cpw) {
                if(strlen($pw)<0){
                    header("Location:/admin/manage-accounts.php?error=Passwords do not match! Please try again");
    
                    exit();
                }else{
                    $fields = [
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                        'email'  => $email,
                        'role' => $role,
                        'password' => password_hash($pw, PASSWORD_DEFAULT),
                    ];
                    
                    $table = 'admins';
                    $error = "An error ocurred during user creation. Please try again!";
                    $msg = "Successfully Created User.";
                    $url = '/admin/manage-accounts.php';
            
                    $func->insert($fields, $table, $msg,$url,$error);
                    $body = "Hello,<br>An account has been created in this email. Use ".$email." and ".$pw." as password";
                    $func->sendMail($email, "Account registration", $body);
                }
            }else{
                header("Location:/admin/manage-accounts.php?error=Passwords do not match! Please try again");
    
                exit();
            }
        }
        
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $table = 'admins';
        $url = '/admin/manage-accounts.php';
        $func->delete($id, $table, $url);
    }
?>
<body>
    
    <?php 
    include('partials/preloader.php') 
    ?>

    <?php include('partials/sidebar.php') ?>
    <div class="main-dashboard-content d-flex flex-column">

        <!-- nav -->
        <?php include('partials/nav.php') ?>

        <div class="row">
            <div class="breadcrumb-area col-6">
                <h1>Manage Users</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="/admin/index.php">Home</a></li>
                    <li class="item">Manage Users</li>
                </ol>
            </div>
            <div class="col-6 justify-content-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-sm btn-success float-right">Add New</a>
            </div>
        </div>

        <div class="manage-jobs-box">
            <h3>Manage Users</h3>
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
            <div class="manage-jobs-table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                    //fetching data
                        $func = new functions();
                        $table = 'admins';
                        $rows = $func->selectWhereNot($table, 'id', $admin);

                        $i = 0;
                    
                        if(is_array($rows)){
                        foreach($rows as $key => $row)
                        { ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td style="text-transform: capitalize;">
                                <?= $row['first_name']; ?>
                            </td>
                            <td style="text-transform: capitalize;"><h5><?= $row['last_name']; ?></td>
                            <td style="text-transform: capitalize;">
                                <?= $row['email']; ?>
                            </td>
                            <td style="text-transform: capitalize;">
                                <?= $row['role']; ?>
                            </td>
                            <td><?= date('d m, Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <ul class="option-list">
                                    <li><button data-bs-toggle="modal" data-bs-target="#delete<?= $row['id']; ?>"                                        
                                     class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete Category" type="button"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?= $row['id']; ?>" name="id">
                                        <p>Are you sure of deleting this category?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" name="delete" class="btn btn-primary">Yes, Delete</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Select Role</label>
                            <select name="role" id="role" class="form-control">
                                <option>Select Role</option>
                                <option value="normal">Normal Admin</option>
                                <option value="super">Super Admin</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="my-inputpw">Password</label>
                            <input id="my-inputpw" class="form-control" type="password" name="pw">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="my-inputcpw">Confirm Password</label>
                            <input id="my-inputcpw" type="password" class="form-control" type="password" name="conf_pw">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include('partials/footer.php') ?>

    </div>

    <!-- scripts -->
    <?php include('partials/scripts.php') ?>
</body>

</html>