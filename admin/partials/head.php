<!DOCTYPE html>
<html lang="en">

<head>

    <?php  
    if (isset($_SESSION['id']) || ($_SESSION['id'] != "")) {
        $user = $func->selectSingle($_SESSION['id'], 'admins');
    }       
    
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/animate.min.css">

    <link rel="stylesheet" href="../assets/fonts/remixicon.css">

    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../assets/css/metismenu.min.css">

    <link rel="stylesheet" href="../assets/css/simplebar.min.css">

    <link rel="stylesheet" href="../assets/css/dropzone.min.css">

    <link rel="stylesheet" href="../assets/css/magnific-popup.css">

    <link rel="stylesheet" href="../assets/css/odometer.min.css">

    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/responsive.css"> 
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <title><?= $page_title; ?></title>

    <link rel="icon" type="image/png" href="../assets/images/favicon.png">
</head>
