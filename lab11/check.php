<?php
$pagetitle = "Check";
require_once "header.php";

//Your authentication code goes here
if(!isset($_SESSION['ID']))
{
    echo '<p>This page requires authentication';
    include_once "footer.php";
    exit();
}

?>
<p>This page has very sensitive information.  Only logged in users should be able to see this page.  If you can see this page, you should be logged in! </p>
<?php
require_once "footer.php";
?>