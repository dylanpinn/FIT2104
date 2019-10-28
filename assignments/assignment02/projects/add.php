<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include("../shared/display_code.php");
include("../shared/connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
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

<?php if (!$_POST) {
    include('./partials/add_project_form.html');
} else {
    $query = "INSERT INTO project (date, name, description, country, city, amount) 
              VALUES ('$_POST[date]', '$_POST[name]', '$_POST[description]',
                      '$_POST[country]','$_POST[city]', '$_POST[amount]')";
    $stmt = $dbh->prepare($query);
    if (!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
    } else {
        ?>
        <div class="container">
            <p>Projects record successfully added</p>
            <a href="projects" class="btn btn-primary">Return to list</a>
        </div>
        <?php
    }
}
?>
<?php
include('../shared/_display_code_btn.html');
?>

</body>
</html>

