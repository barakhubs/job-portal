<?php
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Shortlisted Applications";

    include "partials/head.php";
    $func = new functions();

    if(!isset($_SESSION['candidate']) || ($_SESSION['candidate'] == "")){
        header('location:auth.php');
        exit;
      }

    if (isset($_SESSION['id']) || ($_SESSION['id'] != "")) {
        $auth = $_SESSION['id'];
    }
    //   Change application status
    // acceptor reject
  if(isset($_POST['delete'])){

        $id = $_POST['id'];

        $table = 'applications';

        $url = 'shortlists.php';

        $fun = new functions();
        $result = $fun->delete($id, $table, $url);
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
            <h1>All Applications</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="/">Home</a></li>
                <li class="item">All Applications</li>
            </ol>
        </div>


        <div class="all-applicants-box">
            <h2>Applicants</h2>
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
            <div class="row">
            <?php
                //fetching data
                $func = new functions();
                $table = 'applications';
                $limit = 10;
                $value = 'candidate_id';
                $condition = $_SESSION['id'];
                $rows = $func->selectWhere($table, $value, $condition);

                $i = 0;

                if (is_array($rows)) {
                    foreach ($rows as $key => $row) { ?>
                <div class="col-lg-6 col-md-12">
                    <div class="single-applicants-card">
                        <div class="image">
                            <a href=""><img src="/assets/images/user-img/user-img-other1.jpg"
                                    alt="image"></a>
                        </div>
                        <div class="content">
                            <span><?= $func->selectJob($row['job_id'], 'jobs', 'title'); ?></span>
                            <ul class="job-info">
                                <li><i class="fa fa-map-marker"></i> <?= $func->selectJob($row['job_id'], 'jobs', 'location'); ?></li>
                                <li><i class="fa fa-circle"></i> <?= $func->selectJob($row['job_id'], 'jobs', 'job_type'); ?></li>
                                <li><i class="fa fa-recycle"></i>Status:  <?= $row['status'] ?></li>
                            </ul>
                            <div class="applicants-footer">
                                <ul class="option-list">
                                    <li><a href="/view_application.php?id=<?=$row['id'];?>&&user=<?=$row['candidate_id'];?>&&job=<?=$row['job_id'];?>" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="View Aplication" type="button"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li>
                                        <form action="" method="post">
                                        <input type="hidden" name="id" value="<?=$row['id'];?>">
                                        <button type="submit" name="delete" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete Aplication" type="button"><i
                                                class="fa fa-trash"></i></button></form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
        <!-- footer -->
        <?php include('partials/footer.php') ?>

    </div>

    <!-- scripts -->
    <?php include('partials/scripts.php') ?>
</body>

</html>