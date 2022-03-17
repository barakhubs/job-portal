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

    $jobs_table = 'jobs';

?>
<body>
    <?php
    // <!-- preloader -->
    // include "partials/preloader.php";

    // <!-- navbar -->
    include "partials/navbar.php";

    ?>

    <div class="browse-jobs-area-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Browse Jobs By Specialisms</h2>
                <!-- <div class="bar m-auto"></div> -->
                <p class="m-auto"> jobs live - 20 added today.</p>
            </div>
            <div class="row pt-45">
                <?php
                $rows = $func->select('categories', 9);

                $i = 0;

                if(is_array($rows)){
                foreach($rows as $key => $row)
                { ?>
                <div class="col-lg-3 col-6">
                    <div class="browse-jobs-item">
                        <i class="fa fa-desktop jobs-card-bg"></i>
                        <h3><a href="/search.php?keyword=no-job&category=<?= $row['id']; ?>"><?= $row['title']; ?></a></h3>
                        <p>
                            <?php
                                $table = 'jobs';
                                $id = $row['id'];
                                $jobs = $func->selectRelation($id,$table);
                            ?>
                                (<?= $func->selectCount($table, 'category_id', $id); ?> open positions )
                        </p>
                    </div>
                </div>
                <?php }} ?>

                <div class="col-lg-12 text-center">
                    <div class="browse-btn">
                        <a href="categories.php"> Browse All Categories <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="job-post-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Recent Job Posted</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="job-post-form">
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
            <div class="row">
                <?php
                
                $limit = 6;

                $rows = $func->select('jobs', $limit);


                if(is_array($rows)){
                foreach($rows as $key => $row)
                { ?>
                <div class="col-lg-12">
                    <div class="job-post-card job-post-card-ml">
                        <div class="job-post-img">
                            <a href="job-details.php?id=<?=$row['id']; ?>">
                                <img src="assets/images/recent-job/recent-job4.jpg" alt="Images">
                            </a>
                        </div>
                        <h3><a href="job-details.php?id=<?=$row['id']; ?>"><?= $row['title']; ?></a></h3>
                        <div class="content">
                            <div class="content-item">
                                <ul class="content-list">
                                    <li><i class="fa fa-briefcase"></i> <?= $func->selectOne($row['category_id'], 'categories'); ?></li>
                                    <li><i class="fa fa-map-marker"></i> <?= $row['location']; ?></li>
                                    <li><i class="fab fab-calender-alt"></i> <?=date('d M, Y', strtotime($row['deadline'])); ?></li>
                                </ul>
                                <span class="urgent"><?= number_format($row['salary']).' rial'; ?> <b> / Per Month</b></span>
                            </div>
                            <ul class="content-list2">
                                <li class="urgent"><?= $row['job_type']; ?></li>
                            </ul>
                        </div>
                        <button class="bookmark-btn"><i class="ri-bookmark-line"></i></button>
                    </div>
                </div>
                <?php }} ?>
                <div class="col-lg-12 text-center">
                    <div class="browse-btn">
                        <a href="jobs.php"> Browse All Job Post <i class="fa fa-arrow-right"></i></a>
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