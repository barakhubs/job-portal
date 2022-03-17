<?php
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $func = new functions();
    
    $page_title = "View Application";

    include "partials/head.php";

    if(!isset($_SESSION['candidate']) || ($_SESSION['candidate'] == "")){
        header('location: /admin/auth.php');
        exit;
      }
    if (isset($_GET['id']) || ($_GET['id'] != "")) {
        $application = $_GET['id'];
    }

    if (isset($_GET['user']) || ($_GET['user'] != "")) {
        $candidate = $_GET['user'];
    }

    if (isset($_GET['job']) || ($_GET['job'] != "")) {
        $job = $_GET['job'];
    }
    
    $user = $func->selectSingle($_SESSION['id'], 'admins');

    $candidate = $func->selectSingle($candidate, 'candidates');

    $applicant = $func->selectSingle($application, 'applications');

    $job = $func->selectSingle($job, 'jobs');
    
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
                <h1>Applications</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="/candidate-dashboard.php">Home</a></li>
                    <li class="item">Application</li>
                </ol>
            </div>
    
    
            <div class="my-profile-box" >
                <div class="profile-outer-area-two" id="printContainer">
                <h3>Application Details</h3>
                    <table border="0">
                        <tr>
                            <td>Job Title: </td>
                            <td><?= $job['title']; ?> </td>
                        </tr>
                        <tr>
                            <td>Applicant Names: </td>
                            <td><?=$candidate['first_name']." ".$candidate['last_name']; ?> </td>
                        </tr>
                        <tr>
                            <td>Date of Birth: </td>
                            <td><?= date('M d, Y', strtotime($applicant['date_of_birth'])); ?></td>
                        </tr>
                        <tr>
                            <td>Residence: </td>
                            <td> <?= $applicant['residence']; ?></td>
                        </tr>
                        <tr>
                            <td>Gender: </td>
                            <td><?= $applicant['gender']; ?></td>
                        </tr>
                        <tr>
                            <td>Experience: </td>
                            <td><?= $applicant['experience']; ?> years</td>
                        </tr>
                        <tr>
                            <td>Natinal ID Number: </td>
                            <td><?= $applicant['nin']; ?></td>
                        </tr>
                        <tr>
                            <td>Motivation: </td>
                            <td style="font-style: italic;"><?= $applicant['motivation_letter']; ?> </td>
                        </tr>
                        <tr>
                            <td>Cover Letter: </td>
                            <td><a target="_blank" href="uploads/letters/<?=$applicant['cover_letter']; ?>">Click to download cover letter</a></td>
                        </tr>
                        <tr>
                            <td>CV/Resume: </td>
                            <td><a target="_blank" href="uploads/cv/<?=$applicant['cv']; ?>">Click to download cv</a></td>
                        </tr>
                        <tr>
                            <td>Status: </td>
                            <td><?= $applicant['status']; ?></td>
                        </tr>
                    </table>
                </div>
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-md-6">
                            <button type="button" id="printPDF" class="default-btn"><i class="fa fa-print"></i> Print to pdf <i class="flaticon-send"></i></button>
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