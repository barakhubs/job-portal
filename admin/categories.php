<?php
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

    $page_title = "Manage Job Categories";

    include "partials/head.php";

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
    if (isset($_POST['submit'])) {
        $title = $_POST['category_title'];
        $status = $_POST['status'];

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $table = 'categories';

        $fields = [
            'title'  => $title,
            'slug' => $slug,
            'status' => $status,
        ];
        $error = "An error ocurred category creation. Please try again!";
        $msg = "Successfully Created Category.";
        $url = '/admin/categories.php';

        $func->insert($fields, $table, $msg,$url,$error);
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $table = 'categories';
        $url = '/admin/categories.php';
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
                <h1>Manage Categories</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="dashboard.html">Home</a></li>
                    <li class="item">Manage Categories</li>
                </ol>
            </div>
            <div class="col-6 justify-content-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#addCategory" class="btn btn-sm btn-success float-right">Add New</a>
            </div>
        </div>

        <div class="manage-jobs-box">
            <h3>Manage Categories</h3>
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
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                    //fetching data
                        $func = new functions();
                        $table = 'categories';
                        $rows = $func->select($table, '10');

                        $i = 0;
                    
                        if(is_array($rows)){
                        foreach($rows as $key => $row)
                        { ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td>
                                <h5><?= $row['title']; ?></h5>
                            </td>
                            <td><a href="dashboard-applicants.html">5+ Jobs</a></td>
                            <td><?= date('d m, Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 'active') { ?>
                                    <div class="status">
                                        Active
                                    </div>
                                <?php } elseif ($row['status'] == 'inactive') { ?>
                                    <div class="status bg-warning text-dark">
                                        Inactive
                                    </div>
                                <?php } ?>
                            </td>
                            <td>
                                <ul class="option-list">
                                    <li><button class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="View Category Jobs" type="button"><i
                                                class="fa fa-edit"></i></button></li>
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
        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="">Category Title</label>
                        <input type="text" class="form-control" name="category_title" id="category_title" aria-describedby="helpId" placeholder="">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="">Category Status</label>
                            <select id="status" class="custom-select form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Disabled</option>
                            </select>
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