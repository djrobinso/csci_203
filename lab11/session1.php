<?php
/**
 * Created by PhpStorm.
 * User: jennis
 * Date: 3/23/2016
 * Time: 12:50 PM
 */
    session_start();
    $pagetitle = "Session 1";
    include_once "sessionheader.php";
    $_SESSION['num'] = 15;
    echo $_SESSION['num'];
    include_once "sessionfooter.php";
?>


