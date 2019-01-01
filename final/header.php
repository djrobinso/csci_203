<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:15 AM
 */
session_start();
require_once "connect.php";
?>

<!DOCTYPE html><html>
<head lang="en">
    <meta charset="utf-8">
    <title>Deyonta Robinson</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />

    <!---Add the tiny MCE--->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>

</head>
<body>
<header>

    <!--Create the header and its paragraph underneath-->
    <h1>myBookstore</h1>

    <!--Include your nav.php page--->
    <nav><?php include_once "nav.php"; ?><br><br></nav>
</header>

<!---Showing the page title-->
    <h2><?php echo $pageTitle; ?></h2>


