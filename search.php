<!-- head -->
<?php
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Search Jobs";

    include "partials/head.php";

    
    $func = new functions();

    $jobs_table = 'jobs';

    if (isset($_GET['keyword']) && isset($_GET['category'])) {
        $keyword = $_GET['keyword'];
        $category = '%'.$_GET['category'].'%';
    }


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
                <h3>You Searched for: <?= $keyword; ?></h3>
                <ul>
                    <li>
                        <p>0 results found</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="job-listing-area pt-100 pb-70">
        <div class="container">
            <div class="job-listing-top">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="job-listing-form">
                        <form action="search.php" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" name="keyword" type="text" placeholder="Keywords / Job Title">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group select-group">
                                        <select name="category" class="form-select form-control">
                                            <option data-display='Choose A Category'>Choose A Category</option>
                                            <?php
                                            $rows = $func->select('categories', 9);

                                            $i = 0;

                                            if(is_array($rows)){
                                            foreach($rows as $key => $row)
                                            { ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['title']; ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <button type="submit" class="submit-btn">
                                        Find Jobs
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="job-listing-side-bar">
                        <div class="job-listing-widget">
                            <ul class="accordion-widget">
                                <li class="accordion-widget-item">
                                    <a class="accordion-widget-title" href="javascript:void(0)">
                                        Filter By Category
                                    </a>
                                    <ul class="accordion-widget-content show">
                                    <?php 
                                    $rows = $func->select('categories', 50);

                                    $i = 0;

                                    if(is_array($rows)){
                                    foreach($rows as $key => $row)
                                    { ?>
                                    <li>
                                        <a href="/search.php?keyword=no-job&category=<?= $row['id']; ?>">
                                            <label for=""><?= $row['title']; ?><span class="f1 float-right"><?= $func->selectCount('jobs', 'category_id', $row['id']); ?></span></label>
                                        </a>
                                    </li>
                                    <?php }}?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="job-listing-topper">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="job-listing-title">
                                    <h3>Showing <?= count($func->searchJob('jobs', '%'.$keyword.'%', '%'.$category.'%')); ?> results</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="job-listing-category">
                                    <div class="row">
                                        <div class="col-lg-6 col-6">
                                            <div class="form-group select-group">
                                                <select class="form-select form-control">
                                                    <option data-display='Sort By (Default)'>Sort By (Default)</option>
                                                    <option value="1"> Top Rate</option>
                                                    <option value="2">Mid Rate</option>
                                                    <option value="3">Low Rated</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6">
                                            <div class="form-group select-group">
                                                <select class="form-select form-control">
                                                    <option data-display='06 Per Pages'>06 Per Pages</option>
                                                    <option value="1"> 03 Per Pages</option>
                                                    <option value="2">06 Per Pages</option>
                                                    <option value="3">09 Per Pages</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-45">
                        <?php
                
                        $limit = 10;

                        $rows = $func->searchJob('jobs', '%'.$keyword.'%', '%'.$category.'%');


                        if(count($rows) > 0){
                        foreach($rows as $key => $row)
                        { ?>
                        <div class="col-lg-12">
                            <div class="recent-job-card box-shadow">
                                <div class="content">
                                    <div class="recent-job-img">
                                        <a href="job-details.html">
                                            <img src="assets/images/find-jobs/jobs.jpg" alt="Images">
                                        </a>
                                    </div>
                                    <h3><a href="job-details.php?id=<?=$row['id']; ?>"><?= $row['title']; ?></a></h3>
                                    <ul class="job-list1">
                                        <li><i class="fa fa-briefcase"></i> <?= $func->selectOne($row['category_id'], 'categories'); ?></li>
                                        <li><i class="fab fab-calender-alt"></i> <?= $row['deadline']; ?></li>
                                    </ul>
                                    <span><i class="fa fa-map-marker"></i> <?= $row['location']; ?></span>
                                </div>
                                <div class="job-sub-content">
                                    <ul class="job-list2">
                                        <li class="urgent"><?= $row['job_type']; ?></li>
                                    </ul>
                                    <div class="price"><?= number_format($row['salary']).' rial'; ?> <b> / Per Month</b></div>
                                </div>
                                <button class="bookmark-btn"><i class="fa fa-heart"></i></button>
                            </div>
                        </div>
                        <?php }}else{
                            echo "<p>Your search did not yield any result! Please try again!</p>";
                        }
                         ?>
                        <!-- <div class="col-lg-12 col-md-12 text-center">
                            <div class="pagination-area">
                                <a href="job-listing.html" class="prev page-numbers">
                                    <i class="ri-arrow-left-s-line"></i>
                                </a>
                                <span class="page-numbers current" aria-current="page">1</span>
                                <a href="job-listing.html" class="page-numbers">2</a>
                                <a href="job-listing.html" class="page-numbers">3</a>
                                <a href="job-listing.html" class="next page-numbers">
                                    <i class="ri-arrow-right-s-line"></i>
                                </a>
                            </div>
                        </div> -->
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