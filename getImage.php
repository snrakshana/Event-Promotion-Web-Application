<?php
	$id = $_GET['id'];
	include_once('DB.php');
	$sql = "SELECT image FROM event WHERE event_id=".$id;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	header("Content-type: image/*");
	echo $row['image'];
?>