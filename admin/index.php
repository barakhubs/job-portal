<?php
    session_start();
    function myAutoLoad($class){
        require_once "../config/$class.php";
    }

    spl_autoload_register('myAutoLoad');
    
    $func = new functions();

    $page_title = "Job Portal Admin Dashboard";

    include "partials/head.php";

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }

?>
<body>

    
    <?php  ?>

    

    <?php include('partials/sidebar.php') ?>
    <div class="main-dashboard-content d-flex flex-column">

        <!-- nav -->
        <?php include('partials/nav.php') ?>


        <div class="breadcrumb-area">
            <h1>Howdy, <?= $user['first_name']; ?>!</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="dashboard.html">Home</a></li>
                <li class="item">Dashboard</li>
            </ol>
        </div>


        <div class="dashboard-fun-fact-area">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Posted Jobs</span>
                        <h3><?= $func->dashboardCount("jobs"); ?></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="ri-file-list-line"></i>
                        </div>
                        <span class="sub-title">Application</span>
                        <h3><?= $func->dashboardCount("applications"); ?></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="ri-chat-2-line"></i>
                        </div>
                        <span class="sub-title">Messages</span>
                        <h3>85</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="ri-close-line"></i>
                        </div>
                        <span class="sub-title">Shortlist</span>
                        <h3>4</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-jobs-box">
            <h2>Jobs Applied Recently</h2>
            <div class="row">
            <?php
                //fetching data
                $func = new functions();
                $table = 'applications';
                $limit = 4;
                $rows = $func->select($table, $limit);

                $i = 0;

                if (is_array($rows)) {
                    foreach ($rows as $key => $row) { ?>
                <div class="col-lg-6 col-md-12">
                    <div class="single-applicants-card">
                        <div class="image">
                            <a href="candidates-details.html"><img src="/assets/images/user-img/user-img-other1.jpg"
                                    alt="image"></a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="3"><?= $func->selectCandidate($row['candidate_id'], 'candidates'); ?></a>
                            </h3>
                            <span><?= $func->selectJob($row['job_id'], 'jobs', 'title'); ?></span>
                            <ul class="job-info">
                                <li><i class="fa fa-map-marker"></i> <?= $func->selectJob($row['job_id'], 'jobs', 'location'); ?></li>
                                <li><i class="fa fa-circle"></i> <?= $func->selectJob($row['job_id'], 'jobs', 'job_type'); ?></li>
                            </ul>
                            <div class="applicants-footer">
                                <ul class="option-list">
                                    <li><a href="/admin/view_application.php?id=<?=$row['id'];?>&&user=<?=$row['candidate_id'];?>&&job=<?=$row['job_id'];?>" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="View Aplication" type="button"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li><form action="" method="post">
                                        <input type="hidden" name="id" value="<?=$row['id'];?>">
                                        <button type="submit" name="accept" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Approve Aplication" type="button"><i
                                                class="fa fa-check"></i></button></form>
                                    </li>
                                    <li>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?=$row['id'];?>">
                                            <button type="submit" name="reject" class="option-btn d-inline-block" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Reject Aplication" type="button"><i
                                                class="fa fa-times"></i></button></form>
                                    </li>
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