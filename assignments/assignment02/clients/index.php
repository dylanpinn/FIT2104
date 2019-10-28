<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include_once("../shared/connection.php");
include_once("../shared/display_code.php");

$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$stmt = $dbh->prepare("SELECT * FROM client");
$stmt->execute();

if (array_key_exists('download', $_GET) && $_GET['download'] === 'pdf') {
    include_once('./pdf_download.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../shared/head.php'); ?>
<body>
<?php include('../shared/nav.php'); ?>
<?php

if (array_key_exists('display-code', $_GET) && $_GET['display-code']) {
    display_code('clients');
    return;
}
?>
<div class="container">
    <div class="table-heading-row">
        <h1>Clients</h1>
        <a href="clients/email.php" class="btn btn-secondary">Send Email To Clients</a>
        <a href="clients/add.php" class="btn btn-primary">Add New Client</a>
    </div>

    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Street Address</th>
            <th>Suburb</th>
            <th>Postcode</th>
            <th>State</th>
            <th>Mobile Number</th>
            <th>Email Address</th>
            <th>In Mail List</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmt->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["first_name"]; ?></td>
                <td><?php echo $row["last_name"]; ?></td>
                <td><?php echo $row["street"]; ?></td>
                <td><?php echo $row["suburb"]; ?></td>
                <td><?php echo $row["postcode"]; ?></td>
                <td><?php echo $row["state"]; ?></td>
                <td><?php echo $row["mobile"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["mail_list"]; ?></td>
                <td>
                    <a href="clients/clientModify.php?client_id=<?php echo $row["id"]; ?>&Action=Update">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>

                <td>
                    <a href="clients/clientModify.php?client_id=<?php echo $row["id"] ?>&Action=Delete">
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

    <a href="clients?download=pdf" class="btn btn-secondary" target="_blank">Download as PDF</a>
</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
