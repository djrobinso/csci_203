<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:23 AM
 */
$pageTitle = "Delete Book";
include_once "header.php";
$showform = 1;

//check for authentication
if(!isset($_SESSION['ID'])) {
    echo "<p>This page requires authentication.</p>";
    include_once "footer.php";
    exit();
}

//check for logged in users
if(isset($_SESSION['userid'])){
    echo "<p>You need to be logged in to see this page.</p>";
    include_once "footer.php";
    exit();
}

if(isset($_POST['delete'])) {
    try {
        $sql = 'DELETE FROM djrobinso_items WHERE ID = :ID';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ID', $_POST['ID']);
        $stmt->execute();
        echo "<div class='success'><p>Successfully deleted.</p></div>";
        $showform = 0;
    } catch (PDOException $e) {
        echo "<div class='error'><p>ERROR deleting data!" . $e->getMessage() . "</p></div>";
        include "footer.php";
        exit();
    }
}


    //confirm the title and the id to the user
    if($showform == 1){
?>
        <!--Confirm the detetion of book-->
        <p>Confirm detetion of: <?php echo $_GET['title'];?>(ID no. <?php echo$_GET['ID'];?> )</p>

        <form name="delete" id="delete" method="post" action="itemdelete.php">
            <input type="hidden" name="ID" value="<?php echo $_GET['ID'];?> ">
            <input type="submit" name="delete" value="YES">
            <input type="button" name="nodelete" value="NO" onClick="window.location='itemlist.php'"/>
        </form>

<?php }include_once "footer.php";?>
