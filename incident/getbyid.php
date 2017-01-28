<?php
$ROOT = getenv('APP_ROOT_PATH');
include("$ROOT/mysql/connect_enfd.php");
include('table.php');

$_GET = array_map('strip_tags', $_GET);
$_GET = array_map('htmlspecialchars', $_GET);
$id = $_GET['id'];

if(isset($_GET['strict'])) {
    $strict = $_GET['strict'];
}else{
    $strict = false;
}

$result = mysqli_query($con,"SELECT * FROM $table WHERE id='$id' LIMIT 1");

$rows = array();

while($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
}

print json_encode($rows);
mysqli_close($con);

?>
