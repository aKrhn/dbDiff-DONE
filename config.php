<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$host = $_POST['host'];
$user  = $_POST['user'];
$password =  $_POST['password'];
$database1 = $_POST['dbname1'];
$database2 = $_POST['dbname2'];

$_SESSION['host'] = $host;
$_SESSION['user'] = $user;
$_SESSION['password'] = $password;
$_SESSION['dbname1'] = $database1;
$_SESSION['dbname2'] = $database2;

function createDBInstance($database) {
  global $host, $user, $password;
  try {
      return new PDO("mysql:host=$host;dbname=$database", $user, $password);
  } catch(PDOException $e) {
      die('Could not connect to the database:' . $e);
  }
}

$dbd1 = createDBInstance($database1);
$cn1 = $dbd1 -> query("SHOW TABLES;")-> fetchAll(PDO::FETCH_ASSOC);
$count1 = count($cn1);
$dbd2 = createDBInstance($database2);
$cn2 = $dbd2 -> query("SHOW TABLES;") -> fetchAll(PDO::FETCH_ASSOC);
$count2 = count($cn2);

function arrayCounter($cn, $count)
{
	$db = array();
	for ($i=0, $size = $count; $i < $size ; $i++)
	{
		$db[] = array_values($cn[$i])[0];
	}
	return $db;
};

$db1 = arrayCounter($cn1, $count1);
$db2 = arrayCounter($cn2, $count2);
$common = array_values(array_intersect($db1, $db2));
?>
