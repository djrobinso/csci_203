<?php
    require_once "connect.php";
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Lab 09</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <header>
        <h1>PHP & Intro SQL</h1>
        <nav>
            <ul>
            <?php
                if($_SERVER['PHP_SELF'] != "/djrobinso/csci203sp16/lab09/index.php")
                {
                    echo "<li><a href='index.php'>Home</a></li>";
                }
                else
                {
                    echo "<li>Home</li>";
                }
                if($_SERVER['PHP_SELF'] != "/djrobinso/csci203sp16/lab09/form.php")
                {
                    echo "<li><a href='form.php'>Form</a></li>";
                }
                else
                {
                    echo "<li>Form</li>";
                }
                if($_SERVER['PHP_SELF'] != "/djrobinso/csci203sp16/lab09/selectall.php")
                {
                    echo "<li><a href='selectall.php'>Select All</a></li>";
                }
                else
                {
                    echo "<li>Select All</li>";
                }
            ?>
            </ul>
        </nav>
    </header>
    <section>
        <h2><?php echo $pagetitle; ?></h2>

