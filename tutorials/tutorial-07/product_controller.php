<?php ob_start(); ?>
<?php
include("connection.php");
$dbh = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

var_dump($_POST);
var_dump($_GET);

$action = $_GET['action'];
switch ($action) {
  case "update":
    $query = "UPDATE product set name = ? where id = ?";
    $stmt = $dbh->prepare($query);
    throw Exception;
    $stmt->execute([$_POST['name'], $_GET['product_id']]);
    if (!$stmt->execute()) {
      $err = $stmt->errorInfo();
      echo "Error updating record to database – contact System Administrator
Error is: <b>" . $err[2] . "</b>";
    } else {
      header("Location: products.php");
    }
    break;
  case 'delete':
    $query = "DELETE FROM product where id = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$_GET['product_id']]);
    if (!$stmt->execute()) {
      $err = $stmt->errorInfo();
      echo "Error removing record to database – contact System Administrator
Error is: <b>" . $err[2] . "</b>";
    } else {
      header("Location: products.php");
    }
    break;
}
?>
<?php include('head.html'); ?>

