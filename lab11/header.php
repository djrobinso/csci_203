<?php
    session_start();
    require_once "connect.php";
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Lab 11</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>PHP & Intro SQL</h1>
        <nav>

            <ul>
            <?php
                $currentfile = basename($_SERVER['PHP_SELF']);
                echo ($currentfile == "register.php") ? "<li>Registration</li>" : "<li><a href='register.php'>Registration</a></li>";
                echo ($currentfile == "selectall.php") ? "<li>Select All</li>" : "<li><a href='selectall.php'>Select All</a></li>";
                echo ($currentfile == "phpinfo.php") ? "<li>PHP Info</li>" : "<li><a href='phpinfo.php'>PHP Info</a></li>";
                echo (isset($_SESSION['ID'])) ? "<li><a href='logout.php'>Log Out</a></li>" : "<li><a href='login.php'>Log In</a></li>";
                /*if (isset($_SESSION['ID'])){echo "<li><a href='logout.php'>Log Out</a></li>";}
                else {echo "<li><a href='login.php'>Log In</a></li>";}*/
            ?>
            </ul>
        </nav>
    </header>
        <h2><?php echo $pagetitle; ?></h2>



