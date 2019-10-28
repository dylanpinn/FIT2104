<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include("../shared/connection.php");
include("../shared/display_code.php");

$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$stmt = $dbh->prepare("SELECT * FROM project");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<body>
<?php include('../shared/nav.php'); ?>
<?php

if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('projects');
    return;
}
?>
<div class="container">
    <div class="table-heading-row">
        <h1>Projects</h1>
        <a href="projects/add.php" class="btn btn-primary">Add New Project</a>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Country</th>
            <th>City</th>
            <th>Amount</th>
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
                <td><?php echo $row["date"]; ?></td>
                <td><?php echo $row["country"]; ?></td>
                <td><?php echo $row["city"]; ?></td>
                <td>$<?php echo $row["amount"]; ?></td>
                <td>
                    <a href="projects/projectModify.php?project_id=<?php echo $row["id"]; ?>&Action=Update">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>
                <td>
                    <a href="projects/projectModify.php?project_id=<?php echo $row["id"] ?>&Action=Delete">
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
    <?php $stmt->closeCursor(); ?>
</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
