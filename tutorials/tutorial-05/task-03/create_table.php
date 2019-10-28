<?php

function create_table($rows, $cols)
{
  echo "<table style='border: 1px solid black;'>";
  for ($i = 1; $i <= $rows; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $cols; $j++) {
      echo "<td style='border: 1px solid black;'>";
      echo "Row$i Col$j";
      echo "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
}

create_table(4, 2);
