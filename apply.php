<?php
    ob_start();
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Job Application";
    
    include "partials/head.php";
    
    if(!isset($_SESSION['candidate']) || ($_SESSION['candidate'] == "")){
        header('location:auth.php');
        exit;
      }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    // else{
    //     header('location:index.php');
    //     exit;
    // }

?>
<body>
    <?php
    // <!-- preloader -->
    include "partials/navbar.php";

    // <!-- navbar -->
    $func = new functions();

    
    $job = $func->selectSingle($id, 'jobs');

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $experience = $_POST['experience'];
        $nin = $_POST['nin'];
        $residence = $_POST['residence'];
        
        if (isset($_FILES['cv'])) {

            $cv_file_name = rand(1000, 99999).'-'.$_FILES['cv']['name'];
            $cv_file_size = $_FILES['cv']['size'];
            $cv_file_tmp = $_FILES['cv']['tmp_name'];
            $cv_file_type = $_FILES['cv']['type'];
            $cv_tmp = explode('.', $cv_file_name);
            $cv_file_ext=strtolower(end($cv_tmp));
            
            // if(in_array($cv_file_ext,$extensions) === false || in_array($letter_file_ext,$extensions) === false){
            //     header("Location:apply.php?id=".$id."&&error=Incorrect file types. Check and try again. Only pdf and doc files are required");

            //     exit();
            //  }
             
             if($cv_file_size > 2097152) {
                header("Location:apply.php?id=".$id."&&error=Files should be less than 2MB");

                exit();
             }

             move_uploaded_file($cv_file_tmp,"uploads/cv/".$cv_file_name);
            
        }
        if (isset($_FILES['cover_letter'])){

            $letter_file_name = rand(1000, 99999).$_FILES['cover_letter']['name'];
            $letter_file_size = $_FILES['cover_letter']['size'];
            $letter_file_tmp = $_FILES['cover_letter']['tmp_name'];
            $letter_file_type = $_FILES['cover_letter']['type'];
            $letter_tmp = explode('.', $letter_file_name);
            $letter_file_ext=strtolower(end($letter_tmp));
            
            $extensions= array("pdf","docx");

            // if(in_array($cv_file_ext,$extensions) === false || in_array($letter_file_ext,$extensions) === false){
            //     header("Location:apply.php?id=".$id."&&error=Incorrect file types. Check and try again. Only pdf and doc files are required");

            //     exit();
            //  }
             
             if($letter_file_size > 2097152) {
                header("Location:apply.php?id=".$id."&&error=Files should be less than 2MB");

                exit();
             }
             
             move_uploaded_file($letter_file_tmp,"uploads/letters/".$letter_file_name);

        }
            $motivation_letter = $_POST['motivation_letter'];

             $fields = [
                'job_id'  => $id,
                'date_of_birth'  => $dob,
                'nin'  => $nin,
                'residence'  => $residence,
                'gender'  => $gender,
                'experience'  => $experience,
                'candidate_id'   => $_SESSION['id'],
                'cv' => $cv_file_name,
                'cover_letter' => $letter_file_name,
                'motivation_letter' => $motivation_letter
            ];
            $error = "An error ocurred during your application. Please try again!";
            $msg = "Successfully applied for the job.";
            $url = 'success.php';
            $table = 'applications';   
            
            if ($func->insert($fields,$table,$msg,$url,$error)) {
                header("Location:success.php?error=Successfully applied for the job!");

                exit();
            }
        
    }


    ?>

<div class="user-area pt-100 pb-70">
        <div class="container pt-5">
            
            <div class="inner-banner">
                <div class="container">
                    <div class="inner-title text-center">
                        <h3>Job Application</h3>
                        <p>Applying for: <?=$job['title']; ?></p>
                    </div>
                </div>
            </div>
            <div class="row pt-5 d-flex justify-content-center">
            
                <div class="col-lg-6">
                    <?php
                        if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['error']; ?>
                            </div>
                    <?php }
                        if (isset($_GET['msg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET['msg']; ?>
                            </div>
                    <?php } ?>
                    <div class="user-all-form">
                        <div class="contact-form">
                            <h3> Apply Now!</h3>
                            <form action="apply.php?id=<?=$id;?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Date pf Birth</label>
                                            <input required type="date" name="dob" id="dob" class="form-control" required
                                                data-error="Please enter your date of birth">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Residence</label>
                                            <input required type="text" name="residence" id="residence" class="form-control" required
                                                data-error="Please enter your residence">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>National ID  Number</label>
                                            <input required type="text" name="nin" id="nin" class="form-control" required
                                                data-error="Please enter your national id number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <input required type="number" name="experience" id="experience" class="form-control" required
                                                data-error="Please enter your cover letter">
                                        </div> 
                                    </div>

                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Cover Letter</label>
                                            <input required type="file" name="cover_letter" id="cover_letter" class="form-control" required
                                                data-error="Please enter your cover letter">
                                            <small class="text-muted" style="font-size: 12px!important;">Should be a pdf or doc</small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?=$id;?>">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>CV</label>
                                            <input required type="file" name="cv" id="cv" class="form-control" required
                                                data-error="please upload cv">
                                            <small class="text-muted" style="font-size: 12px!important;">Should be a pdf or doc</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label>Motivation Letter</label>
                                            <textarea name="motivation_letter" min="200" class="form-control" required cols="30" rows="10"></textarea>
                                            <small class="text-muted" style="font-size: 12px!important;">Must contain not less than 200 characters</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <button name="submit" type="submit" class="default-btn">
                                            Apply Now
                                        </button>
                                    </div>
                                </div>
                            </form>
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