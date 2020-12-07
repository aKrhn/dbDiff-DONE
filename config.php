<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$host1 = $_POST['host1'];
$host2 = $_POST['host2'];
$user1  = $_POST['user1'];
$user2  = $_POST['user2'];
$password1 =  $_POST['password1'];
$password2 =  $_POST['password2'];
$database1 = $_POST['dbname1'];
$database2 = $_POST['dbname2'];

$_SESSION['host1'] = $host1;
$_SESSION['host2'] = $host2;
$_SESSION['user1'] = $user1;
$_SESSION['user2'] = $user2;
$_SESSION['password1'] = $password1;
$_SESSION['password2'] = $password2;
$_SESSION['dbname1'] = $database1;
$_SESSION['dbname2'] = $database2;

function createDBInstance($host, $database, $user, $password) {
  try {
      return new PDO("mysql:host=$host;dbname=$database",$user,$password);
  } catch(PDOException $e) {
      die('Could not connect to the database:' . $e);
  }
}

$dbd1 = createDBInstance($host1, $database1, $user1, $password1);
echo "<br>";
var_dump($db1);
echo "</br>";

$cn1 = $dbd1 -> query("SHOW TABLES;")-> fetchAll(PDO::FETCH_ASSOC);
$count1 = count($cn1);
$dbd2 = createDBInstance($host2, $database2, $user2, $password2);
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
