<?php
include("connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>
<!doctype html>
<html lang="en">
<?php include('head.html'); ?>
<body>
<h1>Products</h1>
<?php
$stmt = $dbh->prepare("select * from product");
$stmt->execute();
?>

<table class="bordered">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Update</th>
    <th>Delete</th>
  </tr>
  </thead>
  <tbody>
  <?php
  while ($row = $stmt->fetchObject()) {
    ?>
    <tr>
      <td><?php echo $row->id; ?></td>
      <td><?php echo $row->name; ?></td>
      <td><a href="edit_product.php?product_id=<?php echo $row->id; ?>">Update</a></td>
      <td><a href="remove_product.php?product_id=<?php echo $row->id; ?>">Delete</a></td>
    </tr>
    <?php
  }
  ?>
  </tbody>
</table>
</body>
</html>
