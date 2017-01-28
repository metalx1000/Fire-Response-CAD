<?php
$ROOT = getenv('APP_ROOT_PATH');
include("$ROOT/mysql/connect_enfd.php");
include('table.php');

$_GET = array_map('strip_tags', $_GET);
$_GET = array_map('htmlspecialchars', $_GET);
$unit = $_GET['unit'];

//Get time in minute to go back
$time = $_GET['time'];
//If not set default to 30 minutes
if($time == ""){
  $time = "30";
}

//Convert minutes to seconds
$time = $time*60;

//Get Epoch time of time to go back to
$time = time() - $time;
if(isset($_GET['strict'])) {
    $strict = $_GET['strict'];
}else{
    $strict = false;
}

$result = mysqli_query($con,"SELECT * FROM $table WHERE `timestamp` > $time ORDER BY id DESC");

$rows = array();

while($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
}

print json_encode($rows);
mysqli_close($con);

?>
