<?php
$dbh = new PDO ('mysql:host=130.194.7.82;dbname=s24160547', 's24160547', 'monash00');
$stmt = $dbh->prepare("select * from Category");
$stmt->execute();
?>
<table style="border: 1px solid black;">
  <thead>
  <tr>
    <th>Description</th>
  </tr>
  </thead>
  <tbody>
  <?php
  while ($row = $stmt->fetch()) {
    ?>

    <tr style="border: 1px solid black;">
      <td><?php echo $row["description"]; ?></td>
    </tr>

    <?php
  }
  $stmt->closeCursor();
  ?>

  </tbody>
</table>
