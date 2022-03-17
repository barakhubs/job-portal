<?php
    session_start();
    function myAutoLoad($class){
        require_once "../config/$class.php";
    }

    spl_autoload_register('myAutoLoad');
    
    $func = new functions();

    $page_title = "Manage Jobs";

    include "partials/head.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }else{
        header("Location:index.php");

        exit();
    }
    $job = $func->selectSingle($id, 'jobs');

    if(!isset($_SESSION['admin']) || ($_SESSION['admin'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $job_type = $_POST['job_type'];
        $description = $_POST['description'];
        $experience = $_POST['experience'];
        $qualification = $_POST['qualification'];
        $deadline = $_POST['deadline'];
        $vacancies = $_POST['vacancies'];
        $salary = $_POST['salary'];
        $location = $_POST['location'];

        if ($title == "" || $category == "" || $salary == "" || $job_type == ""|| $description == "" || $experience == "" || $qualification == "" || $deadline == ""|| $vacancies == "" || $location == "") {
            header("Location:/admin/add-job.php?error=Some fields are empty! Try again");
            exit();
        } else {

            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $table = 'jobs';

            $fields = [
                'title'  => $title,
                'slug' => $slug,
                'category_id' => $category,
                'description' => $description,
                'experience' => $experience,
                'qualification' => $qualification,
                'deadline' => $deadline,
                'vacancies' =>$vacancies,
                'location' => $location,
                'salary' => $salary,
                'job_type' => $job_type,
            ];
            $error = "An error ocurred when creating job. Please try again!";
            $msg = "Successfully Updated Job.";
            $url = '/admin/jobs.php';

            $func->update($fields, $id, $table, $url);
        }        
    }
?>
<body>
    
    <?php include('partials/preloader.php') ?>

    <?php include('partials/sidebar.php') ?>
    <div class="main-dashboard-content d-flex flex-column">

        <!-- nav -->
        <?php include('partials/nav.php') ?>

        <div class="row">
            <div class="breadcrumb-area col-6">
                <h1>Manage Jobs</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="/jobs.php">Jobs</a></li>
                    <li class="item">Edit <?= $job['title']; ?></li>
                </ol>
            </div>
            <div class="col-6 justify-content-end">
                <a href="/admin/jobs.php" class="btn btn-sm btn-success float-right">Back to Jobs</a>
            </div>
        </div>


        <div class="post-a-new-job-box">
            <h3>Post New Job</h3>
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
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Job Title</label>
                            <input type="text" class="form-control" value="<?=$job['title'];?>" name="title" placeholder="Job Title Here">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Job Description</label>
                            <textarea cols="30" rows="6" name="description" placeholder="Short description..."
                                class="form-control"><?= htmlspecialchars_decode($job['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group select-group">
                            <label>Job Type</label>
                            <select class="form-select form-control" name="job_type">
                                <option>Select Job Type</option>
                                <option <?php if ($job['job_type'] == 'full-time'){
                                   echo "selected";
                                }?> value="full-time">Full Time</option>
                                <option <?php if ($job['job_type'] == 'part-time'){
                                   echo "selected";
                                }?> value="part-time">Part-Time</option>
                                <option <?php if ($job['job_type'] == 'contract'){
                                   echo "selected";
                                }?> value="contract">Contract</option>
                                <option <?php if ($job['job_type'] == 'internship'){
                                   echo "selected";
                                }?> value="internship">Internship</option>
                                <option <?php if ($job['job_type'] == 'volunteer'){
                                   echo "selected";
                                }?> value="volunteer">Volunteer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group select-group">
                            <label>Job Category</label>
                            <?php
                            //fetching data
                            $func = new functions();
                            $table = 'categories';
                            $rows = $func->select($table, '100');
                            $i = 0;

                            if(is_array($rows)){
                                ?>
                            <select class="form-select form-control" name="category">
                                <option>Select Category</option>
                            
                            <?php 
                            foreach($rows as $row)
                            { ?>
                                <option
                                
                                <?php if ($row['id'] == $job['category_id']){
                                   echo "selected";
                                }?>
                                
                                 style="text-transform: capitalize;" value="<?= $row['id']; ?>"><?= $row['title']; ?></option>
                                
                            <?php } ?>
                            </select>
                            
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group select-group">
                            <label>Experience</label>
                            <select class="form-select form-control" name="experience">
                                <option <?php if ($job['experience'] == '0'){
                                   echo "selected";
                                }?> value="0">Entry Level</option>
                                <option <?php if ($job['experience'] == '2'){
                                   echo "selected";
                                }?> value="2">More Than 2 Yrs</option>
                                <option <?php if ($job['experience'] == '3'){
                                   echo "selected";
                                }?> value="3">More Than 3 Yrs</option>
                                <option <?php if ($job['experience'] == '4'){
                                   echo "selected";
                                }?> value="4">More Than 5 Yrs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group select-group">
                            <label>Qualification</label>
                            <select class="form-select form-control" name="qualification">
                                <option>Select</option>
                                <option <?php if ($job['qualification'] == 'certificate'){
                                   echo "selected";
                                }?> value="certificate">Certificate</option>
                                <option <?php if ($job['qualification'] == 'diploma'){
                                   echo "selected";
                                }?> value="diploma">Diploma</option>
                                <option <?php if ($job['qualification'] == 'bachelors'){
                                   echo "selected";
                                }?> value="bachelors">Bachlors</option>
                                <option <?php if ($job['qualication'] == 'masters'){
                                   echo "selected";
                                }?> value="masters">Masters</option>
                                <option <?php if ($job['qualication'] == 'doctorate'){
                                   echo "selected";
                                }?> value="doctorate">Doctorate</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Application Deadline Date</label>
                            <input type="date" value="<?=$job['deadline'];?>" name="deadline" class="form-control" placeholder="Application Deadline Date">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Vacancies</label>
                            <input type="number" value="<?=$job['vacancies'];?>" name="vacancies" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" value="<?=$job['salary'];?>" class="form-control" placeholder="200,000 rial" name="salary">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" value="<?=$job['location'];?>" class="form-control" placeholder="Zabid" name="location">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <button name="submit" type="submit" class="default-btn">Update Job </button>
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