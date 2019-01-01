<?php
/**
 * Created by PhpStorm.
 * User: Deyonta
 * Date: 4/7/2016
 * Time: 12:23 AM
 */
$pageTitle = "Add New Items";
include_once "header.php";
$inputdate = time();
$showform = 1;
$errormsg = "";

    //check for authicated users
    if(!isset($_SESSION['ID'])){
        echo "<p>This page requires authentication.</p>";
        include_once "footer.php";
        exit();
    }

    if(isset($_POST['submit']))
    {
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
        try{
            $sqltitle = "SELECT * FROM djrobinso_items WHERE title = :title";
            $stmtTitle = $pdo->prepare($sqltitle);
            $stmtTitle->bindValue(':title', $formfield['title']);
            $stmtTitle->execute();
            $countTitle = $stmtTitle->rowCount();
            if($countTitle > 0)
            {
                $errormsg .= "<p>The title of that book is already in the system.</p>";
            }

        }catch(PDOException $e){
            echo "<div class='error'><p></p>ERROR selecting items! ".$e->getMessage()."</p></div>";
            include_once "footer.php";
            exit();
        }//end of the try and catch for finding duplicates

        //if theres errors then display them but if not then try
        //to send the information to the database
        if($errormsg != "")
        {
            echo "<div class='errors'><p>THERE ARE ERRORS!</p>";
            echo $errormsg;
            echo "</div>";
        }else{

            try {
                $sql = "INSERT INTO djrobinso_items (title, summary, afirst, alast, inputdate)
					                  VALUES (:title, :summary, :afirst, :alast, :inputdate)";
                $stmtTitle = $pdo->prepare($sql);
                $stmtTitle->bindValue(':title', $formfield['title']);
                $stmtTitle->bindValue(':summary', $formfield['summary']);
                $stmtTitle->bindValue(':afirst', $formfield['afirst']);
                $stmtTitle->bindValue(':alast', $formfield['alast']);
                $stmtTitle->bindValue(':inputdate', $inputdate);
                $stmtTitle->execute();
                $showform = 0;
                echo "<div class='success'><p>The book has just been added! <a href='itemadd.php'>Lets add another!</a></p></div>";

            }catch(PDOException $e){

                echo "<div class='errors'><p></p>ERROR inserting data into the database! " .$e->getMessage() . "</p></div>";
                include_once "footer.php";
                exit();

            }//end of the try catch

        }//end of it/else error message statement


    }

if($showform == 1){
?>

<!--Beginning of the item add table--->
<form method="post" action="itemadd.php" name="itemadd">
    <fieldset>
        <table class="newItemsTable">
                <tr>
                    <th>Title:</th>
                    <td><input type="text" name="title" id="title" value="<?php if (isset($formfield['title'])){echo $formfield['title'];} ?>" /></td>
                </tr>
                <tr>
                    <th>Author's First Name:</th>
                    <td><input type="text" name="afirst" id="afirst" value="<?php if (isset($formfield['bio'])){echo $formfield['bio'];} ?>" /></td>
                </tr>
                <tr>
                    <th>Author's Last Name:</th>
                    <td><input type="text" name="alast" id="alast" value="<?php if (isset($formfield['alast'])){echo $formfield['alast'];} ?>" /></td>
                </tr>
                <tr>
                    <th>Summary:</th>
                    <td><textarea name="summary" id="summary"><?php if (isset($formfield['summary'])){echo $formfield['summary'];} ?></textarea></td>
                </tr>
                <tr>
                    <th>Submit:</th>
                    <td><input type="submit" name="submit" value="submit"></td>
                </tr>
        </table>
    </fieldset>
</form>


<?php } include_once "footer.php"; ?>
