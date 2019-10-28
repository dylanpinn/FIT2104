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

<?php if (!$_POST) {
    include('./partials/add_client_form.html');
} else {
    $query = "INSERT INTO client (first_name, last_name, street, suburb, postcode, state, mobile, email, mail_list) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($query);
    if (!$stmt->execute([
        $_POST['first_name'], $_POST['last_name'], $_POST["street"], $_POST['suburb'], $_POST['postcode'],
        $_POST['state'], $_POST['mobile'], $_POST['email'], $_POST['mail_list']
    ])) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database - contact System Administrator. Error is :  <b>" . $err[2] . "</b>";
    } else {
        ?>
        <div class="container">
            <p>Customer record successfully added</p>

            <a href="clients" class="btn btn-primary">Return to list</a>
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

