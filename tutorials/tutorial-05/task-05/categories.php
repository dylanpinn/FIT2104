<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
$stmt = $dbh->prepare("select * from Category");
$stmt->execute();
?>
<!doctype html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<table id="cat_table">
  <thead>
  <tr>
    <th>Description</th>
  </tr>
  </thead>
  <tbody>
  <?php
  while ($row = $stmt->fetch()) {
    ?>

    <tr>
      <td><?php echo $row["description"]; ?></td>
    </tr>

    <?php
  }
  $stmt->closeCursor();
  ?>

  </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="script.js"></script>
</body>
