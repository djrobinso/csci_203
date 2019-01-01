<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:23 AM
 */
$pageTitle = "Update The Book";
include "header.php";
$errormsg = "";
$showform = 1;

    //check for authentication
    if(!isset($_SESSION['ID'])) {
        echo "<p>This page requires authentication.</p>";
        include_once "footer.php";
        exit();
    }


if(isset($_POST['submit'])){

    $_GET['ID'] = $_POST['ID'];

    //sanitizt the data
    $formfield['title'] = trim(strtoupper($_POST['title']));
    $formfield['summary'] = trim($_POST['summary']);
    $formfield['afirst'] = trim($_POST['afirst']);
    $formfield['alast'] = trim($_POST['alast']);

    //check for required data
    if(empty($formfield['title'])){$errormsg .= "<p>The book needs a title.</p>";}
    if(empty($formfield['summary'])){$errormsg .= "<p>We need a description of the book.</p>";}
    if(empty($formfield['afirst'])){$errormsg .= "<p>We need the first name of the author.</p>";}
    if(empty($formfield['alast'])){$errormsg .= "<p><We need the last name of the author./p>";}

    //check for duplicate titles
    if($formfield['title'] != $_POST['otitle']) {
        try {
            $sqltitle = "SELECT * FROM djrobinso_items WHERE title = :title";
            $stmtTitle = $pdo->prepare($sqltitle);
            $stmtTitle->bindValue(':title', $formfield['title']);
            $stmtTitle->execute();
            $countTitle = $stmtTitle->rowCount();
            if ($countTitle > 0) {
                $errormsg .= "<p>The title of that book is already in the system.</p>";
            }

        } catch (PDOException $e) {
            echo "<div class='error'><p></p>ERROR selecting items! " . $e->getMessage() . "</p></div>";
            include_once "footer.php";
            exit();
        }//end of the try and catch for finding duplicates
    }

    //if theres errors then display them but if not then try
    //to send the updated information to the database
    if($errormsg != "")
    {
        echo "<div class='errors'><p>THERE ARE ERRORS!</p>";
        echo $errormsg;
        echo "</div>";
    }else{

        try {
            $sql = "UPDATE djrobinso_items SET
                    title = :title, summary = :summary, afirst = :afirst, alast = :alast, inputdate = :inputdate
					WHERE ID = :ID";
            $stmtTitle = $pdo->prepare($sql);
            $stmtTitle->bindValue(':title', $formfield['title']);
            $stmtTitle->bindValue(':summary', $formfield['summary']);
            $stmtTitle->bindValue(':afirst', $formfield['afirst']);
            $stmtTitle->bindValue(':alast', $formfield['alast']);
            $stmtTitle->bindValue(':inputdate', $inputdate);
            $stmtTitle->bindValue(':ID', $_POST['ID']);
            $stmtTitle->execute();
            $showform = 0;
            echo "<div class='success'><p>The book information has just been updated!</p></div>";

        }catch(PDOException $e){

            echo "<div class='errors'><p></p>ERROR inserting data into the database! " .$e->getMessage() . "</p></div>";
            include_once "footer.php";
            exit();

        }//end of the try catch

    }//end of it/else error message statement


}

if($showform == 1){
    $sql = 'SELECT * FROM djrobinso_items WHERE ID = :ID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
    ?>

    <!--Beginning of the item add table--->
    <form method="post" action="itemupdate.php" name="itemupdate">
        <fieldset>
            <table class="newItemsTable">
                <tr>
                    <th>Title:</th>
                    <td><input type="text" name="title" id="title"
                               value="<?php if(isset($formfield['title'])&& !empty($formfield['title'])) {echo $formfield['title'];}else {echo $row['title'];}?>" /></td>
                </tr>
                <tr>
                    <th>Author's First Name:</th>
                    <td><input type="text" name="afirst" id="afirst"
                               value="<?php if(isset($formfield['afirst']) && !empty($formfield['afirst'])) {echo $formfield['afirst'];}else {echo $row['afirst'];}?>" /></td>
                </tr>
                <tr>
                    <th>Author's Last Name:</th>
                    <td><input type="text" name="alast" id="alast"
                               value="<?php if(isset($formfield['alast'])&& !empty($formfield['alast'])) {echo $formfield['alast'];}else {echo $row['alast'];}?>" /></td>
                </tr>
                <tr>
                    <th>Summary:</th>
                    <td><textarea name="summary" id="summary">
                            <?php if(isset($formfield['summary'])&& !empty($formfield['summary'])){echo $formfield['summary'];}else {echo $row['summary'];}?>
                        </textarea></td>
                </tr>
                <tr>
                    <th>Submit:</th>
                    <td><input type="hidden" name="ID" id="ID" value="<?php echo $row['ID'];?>" />
                        <input type="hidden" name="otitle" id="otitle" value="<?php echo $row['title']; ?>"/>
                        <input type="submit" name="submit" value="submit">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>


<?php } include_once "footer.php";?>

