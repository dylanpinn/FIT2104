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
    display_code('products');
    return;
}
?>

<?php if (!$_POST) {
    include('./partials/_form_create.php');
} else {
    $query = "INSERT INTO product (name, purchase_price, sale_price, country_of_origin, description)
              VALUES (?, NULLIF(?, ''), NULLIF(?, ''), ?, ?)";
    $stmt = $dbh->prepare($query);

    if (!$stmt->execute([
        $_POST['name'], $_POST['purchase_price'], $_POST['sale_price'], $_POST['country'],
        $_POST['description']])
    ) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
    } else {
        $product_id = $dbh->lastInsertId();
        // add product category
        if (!empty($_POST['category'])) {
            // for each in the check array, insert to product_category table with product id
            foreach ($_POST['category'] as $cat) {
                $product_cat_query = "INSERT INTO product_category(product_id, category_id) VALUES(?, ?)";
                $stmt = $dbh->prepare($product_cat_query);
                // error check
                if (!$stmt->execute([$product_id, $cat])) {
                    $err = $stmt->errorInfo();
                    echo "pId: " . $product_id . " cID: " . $cat . "   ";
                    echo "Error adding category to product – contact System Administrator
                          Error is: <b>" . $err[2] . "</b>";
                }
            }
        }
        if ($_FILES["image"]["tmp_name"]) {
            $query = "INSERT INTO product_image (product_id, image_name) VALUES (?, ?)";
            $stmt = $dbh->prepare($query);
            if (!$stmt->execute([$product_id, $_FILES['image']['name']])) {
                $err = $stmt->errorInfo();
                echo "Error adding image to product – contact System Administrator
                      Error is: <b>" . $err[2] . "</b>";
            } else {
                $file_location = "../product_images/" . $_FILES["image"]["name"];
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $file_location)) {
                    echo "ERROR: Could Not Move File into Directory";
                } else {
                    $_SESSION['message']['success'] = 'create';
                    $stmt->closeCursor();  //free up the resources
                    header("Location: " . get_current_dir_root() . '/products');
                }
            }
        } else {
            $_SESSION['message']['success'] = 'create';
            $stmt->closeCursor();  //free up the resources
            header("Location: " . get_current_dir_root() . '/products');
        }
    }
}

include('../shared/_display_code_btn.html');
?>

</body>
</html>
