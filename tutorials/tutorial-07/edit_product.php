<?php
include("connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$stmt = $dbh->prepare("select * from product where id = ?");
$stmt->execute([$_GET['product_id']]);
?>
<!doctype html>
<html lang="en">
<?php include('head.html'); ?>
<body>
<?php
$row = $stmt->fetchObject();
?>
<h1>Update Product</h1>
<p>Update product with ID <?php echo $row->id; ?>
<form method="post" action="product_controller.php?action=update&product_id=<?php echo $row->id; ?>">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo $row->name; ?>">
  </div>

  <div class="form-group"
    <?php
    $cat_stmt = $dbh->prepare("select * from category");
    $cat_stmt->execute();
    ?>
    <h3>Categories</h3>
    <?php
    while ($cat_row = $cat_stmt->fetchObject()) {
    ?>
    <div>
      <?php
      $id = preg_replace('/\W+/', '', strtolower(strip_tags($cat_row->description)));
      ?>

      <input type="checkbox" id="<?php echo $id; ?>" name="categories[]" value="<?php echo $cat_row->id; ?>">
      <label for="<?php echo $id; ?>"><?php echo $cat_row->description; ?></label>

    </div>
      <?php
      }
      ?>

    </div>

    <div class="form-group">
      <input type="submit" value="Update">
    </div>
</form>
</body>
</html>
