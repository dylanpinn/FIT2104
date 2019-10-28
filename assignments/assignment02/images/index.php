<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

// Include shared functions.
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
    display_code('images');
    return;
}
?>

<?php
if ($_POST) {
    // Remove all images
    foreach ($_POST['remove'] as $key => $value) {
        // Remove DB entry.
        $query = "DELETE FROM product_image WHERE image_name = ?";
        $stmt = $dbh->prepare($query);
        if (!$stmt->execute([$key])) {
            $err = $stmt->errorInfo();
            echo "Error removing old image from product – contact System Administrator
                  Error is: <b>" . $err[2] . "</b>";
        } else {
            // Remove image from server.
            if (file_exists(__DIR__ . '/../product_images/' . $key)) {
                unlink('../product_images/' . $key);
            }
        }
    }
    $_SESSION['message']['success'] = 'delete';
}
?>

<div class="container">
    <?php
    if (isset($_SESSION['message']) && $_SESSION['message']['success'] == 'delete') {
        include('./partials/_alert_delete_success.html');
        $_SESSION['message'] = null;
    }
    ?>

    <div class="table-heading-row">
        <h1>Product Images</h1>
    </div>
    <?php
    $product_image_path = '../product_images';
    $product_image_dir = opendir($product_image_path);
    ?>
    <form method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Products</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($file = readdir($product_image_dir)): ?>
                <?php
                // Skip current directory, parent directory, keep file.
                if ($file == '.' || $file == '..' || $file == '.keep') {
                    continue;
                }
                ?>

                <tr data-behaviour="check-box-checked">
                    <?php
                    if (is_dir($file)) {
                        echo "<b>" . $file . "</b><br />";
                    } elseif ($file) {
                        ?>
                        <td>
                            <img src="product_images/<?php echo $file; ?>" alt="<?php echo $file; ?>" width="150px"
                                 height="150px">
                        </td>
                        <td><?php echo $file; ?></td>
                        <td>
                            <?php
                            // Find all products using this image.
                            $stmt = $dbh->prepare(
                                "SELECT product.name as product_name, product_image.id as image_id
                                 FROM product
                                 RIGHT JOIN product_image ON product_image.product_id = product.id
                                 WHERE product_image.image_name = ?");
                            $stmt->execute([$file]);
                            $results = $stmt->fetchAll();
                            $product_names = [];
                            foreach ($results as $result) {
                                $product_names[] = $result['product_name'];
                            }
                            echo implode(', ', $product_names);
                            ?>
                        </td>
                        <td>
                            <input title="remove" type="checkbox" data-behaviour="checkbox"
                                   name="remove[<?php echo $file; ?>]">
                        </td>
                        <?php
                    } ?>
                </tr>

            <?php
            endwhile;
            ?>
            </tbody>
        </table>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Remove Images</button>
        </div>
    </form>
    <?php

    closedir($product_image_dir);
    ?>

</div>
<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
