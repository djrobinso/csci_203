<! DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Thanks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php
        echo 'Date of Birth:'.$_POST['dob'].'</br>';
        echo 'First Name:'.$_POST['fname']. '<br>';
        echo 'Middle Initial:'.$_POST['mi']. '<br>';
        echo 'Last Name: '.$_POST['lname']. '<br />';
        echo 'Email: '.$_POST['email']. '<br />';
        echo 'Password: '.$_POST['pwd']. '<br />';
        echo 'Grade Level: '.$_POST['grade']. '<br />';
        echo 'Degree: '.$_POST['degree']. '<br />';
        echo 'Comments: '.$_POST['comments']. '<br />';
    ?>
    <hr>

    <table>
    <?php
        echo '<tr><th>Date of Birth:</th><td>'.$_POST['dob'].'</td></tr>';
        echo '<tr><th>First Name:</th><td> '.$_POST['fname']. '</td></tr>';
        echo '<tr><th>Middle Initial:</th><td>'.$_POST['mi']. '</td></tr>';
        echo '<tr><th>Last Name:</th><td> '.$_POST['lname']. '</td></tr>';
        echo '<tr><th>Email:</th><td>'.$_POST['email']. '</td></tr>';
        echo '<tr><th>Password:</th><td>'.$_POST['pwd']. '</td></tr>';
        echo '<tr><th>Grade Level:</th><td>'.$_POST['grade']. '</td></tr>';
        echo '<tr><th>Degree:</th><td>'.$_POST['degree']. '</td></tr>';
        echo '<tr><th>Comments:</th><td>'.$_POST['comments']. '</td></tr>';
    ?>
    </table>
</body>
</html>