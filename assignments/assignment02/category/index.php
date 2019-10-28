<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include_once("../shared/display_code.php");
include_once("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$stmt = $dbh->prepare("SELECT * FROM category");
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<body>
<?php include('../shared/nav.php'); ?>

<?php
if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('category');
    return;
}
?>

<div class="container">
    <div class="table-heading-row">
        <h1>Category</h1>
        <a href="category/add.php" class="btn btn-primary">Add New Category</a>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmt->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td>
                    <a href="category/categoryModify.php?category_id=<?php echo $row["id"]; ?>&Action=Update">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>
                <td>
                    <a href="category/categoryModify.php?category_id=<?php echo $row["id"] ?>&Action=Delete">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5"><?php echo $stmt->rowCount(); ?> record/s</td>
        </tr>
        </tfoot>
    </table>
    <?php
    $stmt->closeCursor();  //free up the resources
    ?>
</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
