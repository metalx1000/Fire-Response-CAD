<?php
$ROOT = getenv('APP_ROOT_PATH');
include("$ROOT/mysql/connect_enfd.php");
include('table.php');

$_GET = array_map('strip_tags', $_GET);
$_GET = array_map('htmlspecialchars', $_GET);

$count = $_GET['count'];
if($count == ""){
  $count = "1000";
}

if(isset($_GET['strict'])) {
    $strict = $_GET['strict'];
}else{
    $strict = false;
}

$result = mysqli_query($con,"SELECT units FROM $table ORDER BY id DESC LIMIT $count");

$rows = array();

while($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
    print $row[0];
}

//print json_encode($rows);
mysqli_close($con);

?>
