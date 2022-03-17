<?php
    session_start();

    $_SESSION['candidate'] == '';

    $_SESSION['admin'] == '';

    session_destroy();

    header("Location:index.php");