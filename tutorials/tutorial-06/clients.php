<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
$stmt = $dbh->prepare("select * from client");
$stmt->execute();
?>
<!doctype html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tutorial 6 - Task 1</title>
</head>
<body>
<h2>Clients</h2>

<div>
  <a href="create_client.php">Create New Client</a>
</div>
<table id="client_table">
  <thead>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Update</th>
    <th>Delete</th>
  </tr>
  </thead>
  <tbody>
  <?php
  while ($row = $stmt->fetch()) {
    ?>

    <tr>
      <td><?php echo $row["first_name"]; ?></td>
      <td><?php echo $row["last_name"]; ?></td>
      <td><a href="edit_client.php?client_id=<?php echo $row['id']; ?>">Update</a></td>
      <td><a href="remove_client.php?client_id=<?php echo $row['id']; ?>">Delete</a></td>
    </tr>

    <?php
  }
  $stmt->closeCursor();
  ?>

  </tbody>
</table>
</body>
