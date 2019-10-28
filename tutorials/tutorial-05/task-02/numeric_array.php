<?php
$array = [1, 2, -1, 15, 100, 7];
$arrayLength = count($array);

for ($i = 0; $i < $arrayLength; $i++) {
  echo "array at[" . $i . "] is: [" . $array[$i] . "]<br>\n";
}
echo "<br>\n";

// Display sorted asc
echo "Sorted array...<br>\n";

sort($array);

for ($i = 0; $i < $arrayLength; $i++) {
  echo "array at[" . $i . "] is: [" . $array[$i] . "]<br>\n";
}

echo "<br>\n";
// Display sorted desc
echo "Sorted array DESC...<br>\n";

rsort($array);

for ($i = 0; $i < $arrayLength; $i++) {
  echo "array at[" . $i . "] is: [" . $array[$i] . "]<br>\n";
}

echo "<br>\n";
// Display the average, min, max of array
$sum = array_sum($array);
$average = $sum / $arrayLength;

echo "Average is $average";
echo "<br>\n";

$min = min($array);

echo "Min value is $min";
echo "<br>\n";

$max = max($array);

echo "Max value is $max";
echo "<br>\n";
