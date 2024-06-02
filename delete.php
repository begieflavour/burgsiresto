<?php
	
	include 'dbconfig.php';
 
	
	$sql = "DELETE FROM members WHERE rowid = '".$_GET['id']."'";
	$db->query($sql);
 
	header('location: index.php');
?>