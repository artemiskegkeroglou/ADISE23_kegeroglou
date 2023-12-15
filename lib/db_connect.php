<?php
$host='localhost';
$db = 'iee2019067';
require_once "db_upass.php";
$user=root;
$pass='';


$mysqli = new mysqli($host, $user, $pass, $db, null, '/home/student/iee/2019/iee2019057/mysql/run/mysql.sock');
print_r($mysqli);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
?>
