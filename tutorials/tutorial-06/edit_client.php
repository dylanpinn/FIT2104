<?php ob_start(); ?>
<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
$stmt = $dbh->prepare("select * from client where id = ?");
$stmt->execute([$_GET['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tutorial 6 - Task 1</title>
</head>
<body>
<h2>Client Details</h2>

<?php
if ($_POST) {
  $queries = array();
  parse_str($_SERVER['QUERY_STRING'], $queries);

  $query = "UPDATE client set first_name = ?, last_name = ? where id = ?";
  $stmt = $dbh->prepare($query);
  $stmt->execute([$_POST['first_name'], $_POST['last_name'], $queries['client_id']]);
  if (!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator
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
  <p>Update client with ID <?php echo $row->id; ?></p>

  <form method="post">
    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name" required value="<?php echo $row->first_name; ?>">
    </div>
    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name" required value="<?php echo $row->last_name; ?>">
    </div>
    <div class="form-group">
      <input type="submit" value="Update">
    </div>
  </form>
  <?php
}
?>
</body>
</html>


