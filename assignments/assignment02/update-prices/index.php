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
    display_code('update-prices');
    return;
}
?>
<?php

if ($_POST && $_POST['sale_price']):
    foreach ($_POST['sale_price'] as $key => $value) {
        $query = "UPDATE product SET sale_price = NULLIF(?, '') WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $error = false;
        if (!$stmt->execute([$value, $key])) {
            $err = $stmt->errorInfo();
            echo "Error updating record in database – contact System Administrator
                  Error is: <b>" . $err[2] . "</b>";
            $error = true;
        }
        if (!$error) {
            $_SESSION['message']['success'] = 'update';
        }
    }
endif; ?>

<div class="container">
    <?php
    if (isset($_SESSION['message']) && $_SESSION['message']['success'] == 'update') {
        include('./_alert_update_success.html');
        $_SESSION['message'] = null;
    }

    ?>
    <div class="table-heading-row">
        <h1>Update Product Prices</h1>
    </div>
    <?php
    $query = 'SELECT * FROM product';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    ?>

    <form method="post" data-behaviour="disable-submit">
        <table class="table table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $stmt->fetchObject()): ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input title="sale_price" type="number" name="sale_price[<?php echo $row->id; ?>]"
                                   id="sale_price" min="0" step="0.01"
                                   class="form-control" value="<?php echo $row->sale_price; ?>">
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Update</button>
        </div>
    </form>
</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
