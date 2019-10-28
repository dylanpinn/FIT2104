<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

// Include shared functions.
include("./shared.php");
include("../shared/display_code.php");

/*
 * If no product_id in query string then redirect back to product list.
 */
if (!$_GET['product_id'])
    header("Location: " . get_current_dir_root() . '/products');
?>
<?php
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
    display_code('products');
    return;
}
?>
<?php
$stmt = $dbh->prepare("SELECT product.id as product_id, name, country_of_origin, purchase_price, sale_price,
                                        description, product_image.id as image_id, image_name
                                 FROM product
                                 LEFT JOIN product_image ON product_image.product_id = product.id
                                 WHERE product.id = ?");
$stmt->execute([$_GET['product_id']]);
$product = $stmt->fetchObject();

/*
 * If product not found redirect back to product list with warning message.
 */
if (!$product) {
    $_SESSION['message']['failure'] = 'product-find';
    header("Location: " . get_current_dir_root() . '/products');
}


if ($_POST) {
    if (!isset($_POST['product_id'])) {
        echo "Error removing record in database – contact System Administrator
              Error is: <b>Missing Product ID sent to server.</b>";
        return;
    }

    // Check if product has an image
    if ($product->image_id) {
        // If so then remove it
        remove_image_existing_product($dbh, $product);
    }
    //check if product has category
    //get all the category ids for this product
    $prod_cat_stmt = $dbh->prepare("SELECT * FROM product_category WHERE product_id = ?");
    $prod_cat_stmt->execute([$_GET['product_id']]);
    $prod_cat_rows = $prod_cat_stmt->fetchAll();
    $prod_cat_ids = [];
    foreach ($prod_cat_rows as $prod_cat_row) {
        $prod_cat_ids[] = intval($prod_cat_row["category_id"]);
    }
    //delete all the product_category data for this product id
    if(!empty($prod_cat_ids)){
        $stmt = "DELETE FROM product_category WHERE product_id= ?";
        $stmt=$dbh->prepare($stmt);
        if(!$stmt->execute([intval($_GET['product_id'])])){
            $err = $stmt->errorInfo();
            echo "Error deleting category to product – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
        }

    }

    $query = "DELETE FROM product  WHERE id = ?";
    $stmt = $dbh->prepare($query);

    if (!$stmt->execute([$_POST['product_id']])) {
        $err = $stmt->errorInfo();
        echo "Error removing record in database – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
    } else {
        $_SESSION['message']['success'] = 'delete';
        $stmt->closeCursor();  //free up the resources
        header("Location: " . get_current_dir_root() . '/products');
    }

} else {
    include('./partials/_confirm_delete.php');
}

$stmt->closeCursor();  //free up the resources
?>

<?php
include('../shared/_display_code_btn.html');
?>
</body>
</html>
