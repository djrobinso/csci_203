<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 3/23/2016
 * Time: 3:54 PM
 */

$pagetitle = "Delete";
include_once "header.php";

//necessary variables
$showform = 1;

if(isset($_POST['delete']))
{
    try{
        $sql = 'DELETE FROM djrobinso WHERE ID = :ID';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ID', $_POST['ID']);
        $stmt->execute();
        echo "<div class='success'><p>Successfully deleted.</p></div>";
        $showform = 0;
    }
    catch(PDOException $e) {
        echo "<div class='error'><p>ERROR deleting data!".$e->getMessage()."</p></div>";
        include "footer.php";
        exit();
    };
}//if post delete

if($showform = 1)
{?>

    <p>Confirm deletion of ID no.<?php echo $_GET['textbox'];?>(ID no. <?php echo$_GET['ID'];?> ).</p>
    <form name="delete" id="delete" method="post" action="delete.php">
        <input type="hidden" name="ID" value="<?php echo $_GET['ID'];?> ">
        <input type="submit" name="delete" value="YES">
        <input type="button" name="nodelete" value="NO" onClick="window.location='selectall.php'"/>
    </form>

    <?php
}//end if showform
?>

<?php  ?>