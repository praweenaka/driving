<?php

include './connection.php';
$name = time();
$newname = "../images/" . $name . ".jpg";
$file = file_put_contents($newname, file_get_contents('php://input'));

$sql = "Insert into user_data(pic_add) values('$newname')";
$result = mysqli_query($con, $sql) or die("Error in query");
?>

