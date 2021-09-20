
<?php 

//open connection to mysql server

$dbc= mysql_connect('localhost',bucky,123456);

if (!$dbc)
{
	die("Not connected :". mysql_error());
	
}





?>