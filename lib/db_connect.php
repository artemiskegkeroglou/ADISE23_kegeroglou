<?php
$host='localhost';
$db = 'iee2019067_schema';
require_once "../lib/db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;


if(gethostname()=='users.iee.ihu.gr') {
	$mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/iee/2019/iee2019067/mysql/run/mysql.sock');
} else {
		$pass=null;
        $mysqli = new mysqli($host, $user, $pass, $db);
}

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
