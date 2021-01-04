<?php
include 'connection.php';
$id= $_POST['crid'];

$delete= "DELETE FROM register WHERE id={$id}";

$del= $conn->query($delete) or die("Query not execute");

if ($del) {
	echo 1;
}
else {
	echo 0;
}


?>