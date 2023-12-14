<?php
/*require once "db_connect.php";
$mysqli = new mysqli("servername", "username", "password", "dbname");
if($mysqli->connect_error) {
  exit('Could not connect');
}*/
$host='dblabs.iee.ihu.gr';
$db = 'iee2019067';
require_once "db_upass.php";
$user=root;
$pass='';


$mysqli = new mysqli($host, $user, $pass, $db, null, '/home/student/iee/2019/iee2019057/mysql/run/mysql.sock');

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$sql = "SELECT x, y, b_color from board where x=1, y=1";

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