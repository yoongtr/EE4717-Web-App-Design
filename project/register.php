<?php
include "dbconnect.php";
if (isset($_POST['submit'])) {
	if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['username']) || empty ($_POST['password'])) {
	echo "All records to be filled in";
	exit;}
	}
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];    
$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);
	
$sql = "INSERT INTO users (FirstName, LastName, Username, Email, UserPassword) 
		VALUES ('$firstName','$lastName','$username','$email','$password')";

$result = $dbcnx->query($sql);

if (!$result) 
	echo "Your query failed.";
else
	echo "Welcome ". $username . ". You are now registered";
	session_start();  
    $_SESSION['sess_user']=$username;
	$user_query ="SELECT * FROM users WHERE Username='".$username."' AND UserPassword='".$password."'";
	$user_result = $dbcnx->query($user_query);
	$row_user = $user_result->fetch_assoc();
	$_SESSION['sess_user_id']=$row_user['UserID'];
	header("location:index.php");  
	
?>