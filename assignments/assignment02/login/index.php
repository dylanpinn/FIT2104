<?php session_start(); ?>
<?php
include_once('../root.php');
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
    display_code('login');
    return;
}
if ($_POST) {
    if (empty($_POST['userName']) || empty($_POST['password'])) {
        echo "please enter user name and password!";
    } else {
        $stmt = $dbh->prepare("SELECT uname, pword FROM admin WHERE uname= ?");
        $stmt->execute([$_POST['userName']]);
        $result = $stmt->fetchObject();

        // User exists
        if (!empty($result)) {
            // Verify user password.
            $password_correct = password_verify($_POST['password'], $result->pword);

            if ($password_correct) {
                $_SESSION["authenticated"] = true;
                $_SESSION['message']['success'] = 'login';
                header("Location: " . get_current_dir_root() . '/');
            } else {
                $error_msg = 'Login details incorrect. Please try again.';
            }
        } else {
            $error_msg = 'Login details incorrect. Please try again.';
        }
    }
    $stmt->closeCursor();  //free up the resources
}

if (
    isset($_SESSION['message']) &&
    isset($_SESSION['message']['error']) &&
    $_SESSION['message']['error'] == 'login'
): ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" style="margin-top: 15px" role="alert">
            You must be logged in to access this.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php
    $_SESSION['message'] = null;
endif;

include("_form_login.html");

if (isset($error_msg)):
    ?>
    <div class="container">
        <p class="text-danger font-weight-bold"><?php echo $error_msg; ?></p>
    </div>
<?php
endif;
?>

<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>

