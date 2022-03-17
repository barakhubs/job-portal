<?php
session_start();
function myAutoLoad($class)
{
    require_once "config/$class.php";
}

spl_autoload_register('myAutoLoad');

$page_title = "My Account";

include "partials/head.php";

if (!isset($_SESSION['candidate']) || ($_SESSION['candidate'] == "")) {
    header('location: auth.php');
    exit;
}

if (isset($_SESSION['id']) || ($_SESSION['id'] != "")) {
    $auth = $_SESSION['id'];
}

$func = new functions();

$user = $func->selectCandidate($auth, 'candidates');
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
            <h1>Hello, <?= $user; ?>!</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="jobs.php">Home</a></li>
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
                        <h3>100</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <span class="sub-title">Application</span>
                        <h3>
                            <?= $func->selectCount('applications', 'candidate_id', $auth); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="fa fa-comments"></i>
                        </div>
                        <span class="sub-title">Messages</span>
                        <h3>85</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stats-fun-fact-box">
                        <div class="icon-box">
                            <i class="fa fa-calendar-alt"></i>
                        </div>
                        <span class="sub-title">Shortlist</span>
                        <h3>
                            23
                        <?php
                        // $func->selectCount('applications', 'status', 'accepted'); 
                        ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="dashboard-jobs-box">
            <h2>Jobs Applied Recently</h2>
            <div class="row">
            <?php
                //fetching data
                $func = new functions();
                $table = 'applications';
                $limit = 4;
                $value = 'candidate_id';
                $condition = $_SESSION['id'];
                $rows = $func->selectWhere($table, $value, $condition);

                $i = 0;

                if (is_array($rows)) {
                    foreach ($rows as $key => $row) { 
                        $job = $func->selectOne($row['job_id'], 'jobs');
                        ?>
                <div class="col-lg-6">
                    <div class="recent-job-card box-shadow">
                        <div class="content">
                            <div class="recent-job-img">
                                <a href="/job-details.php?id=<?=$row['job_id']; ?>">
                                    <img src="assets/images/recent-job/recent-job4.jpg" alt="Images">
                                </a>
                            </div>
                            <h3><a href="/job-details.php?id=<?=$row['job_id']; ?>"><?= $job['title']; ?></a></h3>

                            <ul class="job-list1">
                                <li><i class="ri-briefcase-line"></i> Design</li>
                                <li><i class="ri-time-line"></i> <?=date('d M, Y', strtotime($row['deadline'])); ?></li>
                            </ul>
                            <span><i class="ri-map-pin-line"></i> <?= $row['location']; ?></span>
                        </div>
                        <div class="job-sub-content">
                            <ul class="job-list2">
                                <li class="time"><?= $row['job_type']; ?></li>
                                <li class="freelance"><?= $row['status']; ?></li>
                                <li class="urgent">Urgent</li>
                            </ul>
                            <div class="price">$150 - $180 <b>/Per Week</b></div>
                        </div>
                        <button class="bookmark-btn"><i class="ri-close-line"></i></button>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div> -->


        <!-- footer -->
        <?php include('partials/footer.php') ?>

    </div>

    <!-- scripts -->
    <?php include('partials/scripts.php') ?>
</body>

</html>