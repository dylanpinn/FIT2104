<?php ob_start(); ?>
<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
?>
<!doctype html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tutorial 6 - Task 1</title>
</head>
<body>
<h2>Create new client</h2>

<?php
if ($_POST) {
  $query = "INSERT INTO client (first_name, last_name) VALUES (?, ?)";
  $stmt = $dbh->prepare($query);
  $stmt->execute([$_POST['first_name'], $_POST['last_name']]);
  
  if (!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator
Error is: <b>" . $err[2] . "</b>";
  } else {
    header("Location: clients.php");
  }
}
?>

<form method="post">
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" required>
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" required>
  </div>
  <div class="form-group">
    <input type="submit" value="Create">
  </div>
</form>
</body>

