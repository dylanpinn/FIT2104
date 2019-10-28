<?php ob_start(); ?>
<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
$stmt = $dbh->prepare("select * from client where id = ?");
$stmt->execute([$_GET['client_id']]);
?>
<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tutorial 6 - Task 1</title>
</head>
<body>
<h2>Client Details</h2>

<?php
if ($_POST) {
  $query = "DELETE FROM client where id = ?";
  $stmt = $dbh->prepare($query);
  $stmt->execute([$_POST['client_id']]);

  if (!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error removing record in database – contact System Administrator
Error is: <b>" . $err[2] . "</b>";
  } else {
    header("Location: clients.php");
  }
}
?>


<?php
$row = $stmt->fetchObject();
?>

<?php
if ($_GET['client_id']) {
?>
<p>Remove client with ID <?php echo $row->id; ?></p>

<form method="post">
  <div class="form-group">
    <input type="hidden" value="<?php echo $row->id; ?>" name="client_id">
    <input type="submit" value="Remove">
  </div>
</form>
<?php
}
?>
</body>
</html>
