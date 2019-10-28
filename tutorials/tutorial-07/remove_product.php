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
<h1>Remove Product</h1>
<p>Are you sure you want to remove product with ID <?php echo $row->id; ?>?</p>

<form method="post" action="product_controller.php?action=delete&product_id=<?php echo $row->id; ?>">
  <input type="submit" value="Remove">
  <a href="products.php">Cancel</a>
</form>
</body>
</html>

