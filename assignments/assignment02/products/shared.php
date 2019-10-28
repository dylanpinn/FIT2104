<?php

/**
 * Upload a new image for an existing product.
 * @param PDO $dbh
 * @param Object $product
 */
function upload_new_image_existing_product($dbh, $product)
{
    // Create new record for image
    $query = "INSERT INTO product_image (product_id, image_name) VALUES (?, ?)";
    $stmt = $dbh->prepare($query);
    if (!$stmt->execute([$product->product_id, $_FILES['image']['name']])) {
        $err = $stmt->errorInfo();
        echo "Error adding image to product – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
    } else {
        // Upload image
        $file_location = "../product_images/" . $_FILES["image"]["name"];
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $file_location)) {
            echo "ERROR: Could Not Move File into Directory";
        }
    }
}

/**
 * Remove an image from an existing image.
 * @param PDO $dbh
 * @param Object $product
 */
function remove_image_existing_product($dbh, $product)
{
    $query = "DELETE FROM product_image where id = ?";
    $stmt = $dbh->prepare($query);
    if (!$stmt->execute([$product->image_id])) {
        $err = $stmt->errorInfo();
        echo "Error removing old image from product – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
    } else {
        // check if image is used by any other product. If not then remove it.
        $query = "SELECT * FROM product_image WHERE image_name = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$product->image_name]);

        if ($stmt->rowCount() === 0) {
            if (file_exists(__DIR__ . '/../product_images/' . $product->image_name)) {
                unlink('../product_images/' . $product->image_name);
            }
        }
    }
}
