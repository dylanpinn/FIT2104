<?php
ob_start();
session_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

// Include shared functions.
include_once("./shared.php");
include_once("../shared/display_code.php");
?>
<?php
/*
 * If no product_id in query string then redirect back to product list.
 */
if (!$_GET['product_id'])
    header("Location: " . get_current_dir_root() . '/products');
?>
<?php
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

/**
 * Handle success
 */
function process_success()
{
    $_SESSION['message']['success'] = 'update';
    header("Location: " . get_current_dir_root() . '/products');
}

if ($_POST) {
    if ($_POST['remove_image']) {
        remove_image_existing_product($dbh, $product);
        process_success();
    }

    $query = "UPDATE product
              SET name = ?, purchase_price = NULLIF(?, ''), sale_price = NULLIF(?, ''),
                  country_of_origin = ?, description = ?
              WHERE id = ?";
    $stmt = $dbh->prepare($query);

    if (!$stmt->execute([
        $_POST['name'], $_POST['purchase_price'], $_POST['sale_price'], $_POST['country'],
        $_POST['description'], $_GET['product_id']])
    ) {
        $err = $stmt->errorInfo();
        echo "Error updating record in database – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
    } // update product category
    else {
        if (!empty($_POST['category'])) {
            // remove existing product categories :
            $prod_cat_stmt = $dbh->prepare("DELETE * FROM product_category WHERE product_id = ?");
            $prod_cat_stmt->execute([$_GET['product_id']]);

            // for each in the check array, insert to product_category table with product id
            foreach ($_POST['category'] as $cat) {
                $product_cat_query = "INSERT INTO product_category(product_id, category_id) VALUES(?, ?)";
                $stmt = $dbh->prepare($product_cat_query);
                // error check
                if (!$stmt->execute([$_GET['product_id'], $cat])) {
                    $err = $stmt->errorInfo();
                    echo "pId: " . $_GET['product_id'] . " cID: " . $cat . "   ";
                    echo "Error adding category to product – contact System Administrator
                          Error is: <b>" . $err[2] . "</b>";
                }
            }
        }

        if ($_FILES["image"]["tmp_name"]) {
            // Check if product has an image
            if ($product->image_id) {
                // If so then remove it
                remove_image_existing_product($dbh, $product);
                // Old image has now been removed from DB and FileSystem.
                upload_new_image_existing_product($dbh, $product);
                process_success();
            } else {
                upload_new_image_existing_product($dbh, $product);
                process_success();
            }
        } else {
            process_success();
        }
    }
} else {
    include('./partials/_form_edit.php');
}

include('../shared/_display_code_btn.html');
?>

</body>
</html>
