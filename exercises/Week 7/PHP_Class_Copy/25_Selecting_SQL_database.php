
<?php 

$dbc= mysql_connect('localhost',bucky,123456);

if (!$dbc)
{
	die("Not connected :". mysql_error());
	
}

// select database

$db_selected = mysql_select_db("Firsttable", $dbc);

if (!$db_selected)
{
	die("cant be connected :" . mysql_error());
	
}




?>