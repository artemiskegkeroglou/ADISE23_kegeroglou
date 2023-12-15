<?php

$sql = "SELECT x, y, b_color from board where x=1 and y=1";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($x, $y, $b_color);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>";
echo "<th>x</th>";
echo "<td>" . $x . "</td>";
echo "<th>y</th>";
echo "<td>" . $y . "</td>";
echo "<th>color</th>";
echo "<td>" . $b_color . "</td>";
echo "</tr>";
echo "</table>";
?>