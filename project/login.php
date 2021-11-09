<?php
include "dbconnect.php";
if (isset($_POST['login'])) {
	if (empty($_POST['username']) || empty ($_POST['password'])) {
	echo "All records to be filled in";
	exit;}
	}   
$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
$query ="SELECT * FROM users WHERE Username='".$username."' AND UserPassword='".$password."'";
$result = $dbcnx->query($query);
if ($result!=0){
    while ($row = $result->fetch_assoc()){
        $dbusername=$row['Username'];  
        $dbpassword=$row['UserPassword'];
        $dbuserID=$row['UserID'];
    }
    if($username == $dbusername && $password == $dbpassword)  
        {  
        session_start();  
        $_SESSION['sess_user']=$username;
        $_SESSION['sess_user_id']=$dbuserID;
        header("Location: my-account.php");  
        }
    else{
        header("Location:login-fail.html");
    }  
    } 
else {  
    header("Location:login-main.php");  
    }
?>