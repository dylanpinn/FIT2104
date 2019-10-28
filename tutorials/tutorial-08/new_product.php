<?php
include("connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>
<!doctype html>
<html lang="en">
<?php include('head.html'); ?>
<body>
<h1>Create New Product</h1>

<?php
if ($_POST) {
  // TODO: Perform server side validations here.

  $query = "INSERT INTO product (name, purchase_price, sale_price, country_of_origin) VALUES (?, ?, ?, ?)";
  $stmt = $dbh->prepare($query);

  if (!$stmt->execute([$_POST['name'], $_POST['purchase_price'], $_POST['sale_price'], $_POST['country_of_origin']])) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator
          Error is: <b>" . $err[2] . "</b>";
  } else {
    echo "Product successful created.";
    if (isset($_FILES["image"]["tmp_name"])) {
      $product_id = $dbh->lastInsertId();
      $query = "INSERT INTO product_image (product_id, image_name) VALUES (?, ?)";
      $stmt = $dbh->prepare($query);
      if (!$stmt->execute([$product_id, $_FILES['image']['name']])) {
        $err = $stmt->errorInfo();
        echo "Error adding image to product – contact System Administrator
              Error is: <b>" . $err[2] . "</b>";
      } else {
        $file_location = "product_images/" . $_FILES["image"]["name"];
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $file_location)) {
          echo "ERROR: Could Not Move File into Directory";
        } else {
          echo "Product image successfully created.";
        }
      }
    }
  }
}
?>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" required>
  </div>
  <div class="form-group">
    <label for="purchase_price">Purchase Price</label>
    <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01">
  </div>
  <div class="form-group">
    <label for="sale_price">Sale Price</label>
    <input type="number" name="sale_price" id="sale_price" min="0" step="0.01">
  </div>
  <div class="form-group">
    <label for="country_of_origin">Country of Origin</label>
    <input type="text" name="country_of_origin" id="country_of_origin">
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
  </div>
  <div class="form-group">
    <input type="submit" value="Create">
  </div>
</form>
</body>
</html>
