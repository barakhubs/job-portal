<?php
session_start();
function myAutoLoad($class)
{
    require_once "../config/$class.php";
}

spl_autoload_register('myAutoLoad');

$func = new functions();

$page_title = "Manage Jobs";

include "partials/head.php";

if (!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")) {
    header('location: /admin/auth.php');
    exit;
}

// deleting job
if(isset($_POST['delete'])){

    $id = $_POST['id'];

    $table = 'applications';

    $url = '/admin/applications.php';

    $result = $func->delete($id, $table, $url);
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

        <div class="row">
            <div class="breadcrumb-area col-6">
                <h1>Manage Jobs</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="/admin">Home</a></li>
                    <li class="item">Manage Jobs</li>
                </ol>
            </div>
            <div class="col-6 justify-content-end">
                <a href="/admin/add-job.php" class="btn btn-sm btn-success float-right">Add New</a>
            </div>
        </div>

        <div class="manage-jobs-box">
            <h3>Manage Jobs</h3>
            <div class="manage-jobs-table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/n</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Deadline</th>
                            <th>Applications</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        //fetching data
                        $funcc = new functions();
                        $table = 'jobs';
                        $limit = 10;
                        $rows = $funcc->select($table, $limit);

                        $i = 0;

                        if (is_array($rows)) {
                            foreach ($rows as $key => $row) { ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td>
                                        <h5><?= $row['title']; ?></h5>
                                    </td>
                                    <td>
                                        <?php
                                        echo $funcc->selectOne($row['category_id'], 'categories');
                                        ?>
                                    </td>
                                    <td><?= date('d m, Y', strtotime($row['created_at'])); ?></td>
                                    <td><?= date('d m, Y', strtotime($row['deadline'])); ?></td>
                                    <td><a href="dashboard-applicants.html">5+ Jobs</a></td>
                                    <td>
                                        <ul class="option-list">
                                            <li><a type="button" target="_blank" href="/job-details.php?id=<?=$row['id']; ?>" class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="View Job" type="button"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="edit-job.php?id=<?=$row['id']; ?>" class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Job" type="button"><i class="fa fa-edit"></i></a></li>
                                            <li>
                                                    <form action="" method="post">
                                                <input type="hidden" name="id" value="<?=$row['id'];?>">
                                                <button type="submit" name="delete" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete Aplication" type="button"><i
                                                    class="fa fa-trash"></i></button></form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- footer -->
        <?php include('partials/footer.php') ?>

    </div>

    <!-- scripts -->
    <?php include('partials/scripts.php') ?>
</body>

</html>