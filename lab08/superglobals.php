<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Super Global Examples</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>SERVER Super Global</h1>

    <h2>PHP_SELF displays:</h2>
    <?php
        echo $_SERVER['PHP_SELF'];
    ?>

    <h2>SERVER_NAME displays:</h2>
    <?php
        echo $_SERVER['SERVER_NAME'];
    ?>

    <h2>SERVER_SOFTWARE displays:</h2>
    <?php
        echo $_SERVER['SERVER_SOFTWARE'];
    ?>

    <h2>REMOTE_ADDR displays:</h2>
    <?php
        echo $_SERVER['REMOTE_ADDR'];
    ?>

    <h2>HTTP_USER_AGENT displays:</h2>
    <?php
        echo $_SERVER['HTTP_USER_AGENT'];
    ?>

    <h2>HTTP_REFERER displays:</h2>
    <?php
    echo $_SERVER['HTTP_REFERER'];
    ?>

    <h2>REQUEST_TIME displays:</h2>
    <?php
    echo $_SERVER['REQUEST_TIME'];
    ?>

</body>
</html>
