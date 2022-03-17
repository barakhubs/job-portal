<?php
    ob_start();
    session_start();
    function myAutoLoad($class){
        require_once "config/$class.php";
    }

    spl_autoload_register('myAutoLoad');

    $page_title = "Application Success";
    
    include "partials/head.php";
   

?>
<body>
    <?php
    // <!-- preloader -->
    include "partials/navbar.php";

    ?>

<div class="user-area pt-100 pb-70">
        <div class="container pt-5">            
            <div class="row pt-5 d-flex justify-content-center">
                <?php 
                        if (isset($_GET['msg'])) { ?>
                            <div class="col-lg-10 alert alert-success text-center" role="alert">
                                <?php echo $_GET['msg']; ?>
                            </div>
                <?php } ?>
                <div class="col-lg-10">
                    <h4>You have successfully applied for a position with us. Please always check your account for your application progress</h4>
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