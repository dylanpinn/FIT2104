<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include_once("../shared/display_code.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<?php include('../shared/nav.php'); ?>
<?php

if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('category');
    return;
}
?>

<script lang="js">
    function confirm_delete() {
        window.location = 'category/categoryModify.php?category_id=<?php echo $_GET["category_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php
include_once("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$query = "select * from category where id = " . $_GET["category_id"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetchObject();

$strAction = $_GET["Action"];

switch ($strAction) {
    //update page
    case "Update":
        ?>
        <div class="container">
            <div class="table-heading-row">
                <h1>Update Category Information For Category ID: <?php echo $row->id; ?></h1>
            </div>
            <form method="post"
                  action="category/categoryModify.php?category_id=<?php echo $_GET["category_id"]; ?>&Action=ConfirmUpdate">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" required class="form-control"
                           value="<?php echo $row->name; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Update</button>
                    <a href="category/index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        break;
    //confirm update page
    case "ConfirmUpdate":
        $query = "UPDATE category set name='$_POST[name]'
                  WHERE id = ?";
        $stmt = $dbh->prepare($query);

        if (!$stmt->execute([$_GET["category_id"]])) {
            $err = $stmt->errorInfo();
            echo "Error updating record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
            ?>
            <a onclick="history.back()" class="btn btn-primary">Go Back</a>
            <?php
        } else {
            ?>
            <div class="container">
                <h1>Category record successfully updated</h1>
                <button class="btn btn-primary" OnClick="window.location='category/index.php'">Ok</button>
            </div>
            <?php
        }

        break;
    //delete page
    case "Delete":
        ?>
        <div class="container">
            <div class="table-heading-row">
                <h1>Delete Category (ID: <?php echo $row->id; ?>) </h1>
            </div>
            <div class="table-heading-row">
                <p>Are you sure you want to delete this category? - <?php echo $row->name; ?> </p>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" onclick="confirm_delete()">Confirm</button>
                <a href="category/index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>

        <?php
        break;
    //confirm delete page
    case "ConfirmDelete":
        $query = "DELETE FROM category WHERE id = ?";
        $stmt = $dbh->prepare($query);
        if ($stmt->execute([$_GET["category_id"]])) {
            ?>
            <div class="container">
                <h1>The following category record has been successfully deleted</h1>
                <p>
                    <?php echo "Category No. $row->id $row->name"; ?>
                </p>

                <a href="category" class="btn btn-primary">Ok</a>
            </div>
            <?php

        } else {
            $err = $stmt->errorInfo();
            echo "Error updating record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
            ?>
            <form>
                <input type="button" value="Go back" onclick="history.back()">
            </form>
            <?php
        }
        break;
}
$stmt->closeCursor();
?>
<?php
include('../shared/_display_code_btn.html');
?>

</html>
