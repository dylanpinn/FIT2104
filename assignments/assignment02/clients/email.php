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
$stmt = $dbh->prepare("SELECT * FROM client WHERE mail_list = 'Y' ");
$stmt->execute();

if ($_POST) {
    if (isset($_POST["check"])) {
        $chk = $_POST["check"];
        $emails = implode(",", $chk);
        $from = "From: Harry Helper<ymaa0027@monash.edu.au>";
        $msg = $_POST["message"];
        $subject = $_POST["subject"];
        $to = $emails;
        if (mail($to, $subject, $msg, $from)) {
            $msg = "Mail Sent";
        } else {
            $msg = "Error Sending Mail.";
        }

    } else {
        $msg = "Please select client to send email.";
    }
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
        <h1>Clients In The Mail List</h1>
    </div>
    <form method="post" action="clients/email.php">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Select To Send Email</th>
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
                    <td><?php echo $row["email"]; ?></td>
                    <td colspan="1"><input type="checkbox" aria-label="checkbox" name="check[]"
                                           value="<?php echo $row["email"] ?>">
                    </td>
                </tr>
                <?php
            }
            ?>
            <?php
            $stmt->closeCursor();  //free up the resources
            ?>
            </tbody>
        </table>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" placeholder="Enter the subject" class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message"
                      placeholder="Email content"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Send">
            <button type="button" class="btn btn-secondary" OnClick="window.location='clients/index.php'">
                Cancel
            </button>
        </div>

        <p>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
        </p>
</div>

<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
