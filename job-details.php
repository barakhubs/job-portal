<!-- head -->
<?php
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Job Portal Home";

    include "partials/head.php";

    
    $func = new functions();

    //get single job

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }else{
        header("Location:index.php");

        exit();
    }
    $job = $func->selectSingle($id, 'jobs');

?>
<body>
    <?php
    // <!-- preloader -->
    // include "partials/preloader.php";

    // <!-- navbar -->
    include "partials/navbar.php";

    ?>
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Job Details</h3>
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>Job Details</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="job-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="find-jobs-card d-flex align-items-center box-shadow">
                        <div class="find-jobs-img">
                            <a href="company-details.html">
                                <img src="assets/images/find-jobs/jobs.jpg" alt="Images">
                            </a>
                        </div>
                        <div class="content">
                            <ul class="content-list">
                                <li class="time">Full Time</li>
                                <li class="freelance">Freelance</li>
                                <li class="internship">Internship</li>
                            </ul>
                            <h3><?= $job['title'];?></h3>
                            <ul class="content-list2">
                                <li class="list-one"> Coding Agency</li>
                                <li class="list-two"><i class="fa fa-calender-alt"></i> Posted on: <?=date('d M, Y', strtotime($job['created_at'])); ?></li>
                            </ul>
                            <ul class="content-list3">
                                <li><i class="fa fa-briefcase"></i> Category : <b><?=$func->selectOne($job['category_id'], 'categories'); ?></b></li>
                                <li><i class="fa fa-map-marker"></i> Location : <b><?=$job['location']; ?></b></li>
                                <li><i class="fa fa-dollar"></i>Salary : <b><?=number_format($job['salary']).' rial'; ?></b></li>
                            </ul>
                        </div>
                        <div class="find-jobs-btn">
                            <a href="apply.php?id=<?=$job['id'];?>" class="default-btn border-radius-5">Apply
                                Now<i class="fa fa-paper-plane"></i></a>
                        </div>
                        <button class="bookmark-btn"><i class="ri-bookmark-line"></i></button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="job-details-widget-side pr-20">
                        <div class="job-details-widget">
                            <h3 class="title">Job Overview</h3>
                            <div class="bar"></div>
                            <ul class="job-details-category">
                                <li>Published On: <span><?=date('d M, Y', strtotime($job['created_at'])); ?></span></li>
                                <li>Vacancy: <span><?=$job['vacancies']; ?></span></li>
                                <li>Job Type: <span><?=$job['job_type']; ?></span></li>
                                <li>Experience: <span><?=$job['experience']; ?></span></li>
                                <li>Job Location: <span><?=$job['location']; ?></span></li>
                                <li>Category: <span><?=$func->selectOne($job['category_id'], 'categories'); ?></span></li>
                                <li>Application Due: <span><?=date('d M, Y', strtotime($job['deadline'])); ?></span></li>
                            </ul>
                            <div class="job-details-social">
                                <span>Share Post:</span>
                                <ul class="social-icon">
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="job-details-content">
                        <div class="content mb-30">
                            <h3>Job Description</h3>
                            <p>
                                <?php
                                    echo htmlspecialchars_decode($job['description']);
                                ?>
                            </p>
                        </div>
                        <div class="article-social-icon">
                            <ul class="social-icon">
                                <li class="title">Share Post</li>
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
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