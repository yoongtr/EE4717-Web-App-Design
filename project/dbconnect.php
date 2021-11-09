<?php
@$dbcnx = new mysqli('localhost','f32ee','f32ee','f32ee');
if ($dbcnx->connect_error){
	echo "Database is not online"; 
	exit;
	}
if (!$dbcnx->select_db ("f32ee"))
	exit("<p>Unable to locate the f32ee database</p>");
?>	