<!DOCTYPE html>
<?php


    require_once "connect.php"; ?>

<div>
    <head lang="en">
        <meta charset="utf-8">
        <title>Comics 3000 Registration Page</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
</div>

<div class="top">
    <header>
        <h1 id="topheading">Comics 3000<br>Welcome The New Millennium</h1>
        <p id="heading">Here at Comics 3000 we are glad to see you want to become a part of our community and
            you couldn't have chosen a better time! During this month all who register now is
            automatically entered into our Flash contest!!! The winner of the contest is awarded
            the chance to cameo in the season three opener of The Flash.</p>
        <nav>
            <ul>

                <!--Including links to selectall.php and index.php --->
                <?php
                    if($_SERVER['PHP_SELF'] != '/djrobinso/csci203sp16/a4/index.php')
                    {
                        echo "<li><a href='index.php'>Registration Page</a></li>";

                    }else{

                        echo "<li> Registration Page</li>";
                    }
                    if($_SERVER['PHP_SELF'] != '/djrobinso/csci203sp16/a4/selectall.php')
                    {
                        echo "<li><a href='selectall.php'>View Registered Contestants</a></li>";
                    }else{

                        echo "<li>View Registered Contestants</li>";
                    }
                ?>

            </ul>
        </nav>
    </header>
</div>

<body background="images/wallup-54346.jpg">
<!----
<body>
    <header>
        <h1></h1>
        <nav></nav>
    </header>
</body>---->

