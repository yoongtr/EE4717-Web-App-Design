<?php
include "dbconnect.php";
session_start();
if (isset($_POST['submit'])) {
	if (empty($_POST['myItem']) || empty($_POST['myColour']) || empty($_POST['myMeme']) || empty($_POST['myAddress'])) {
	echo "All records to be filled in";
	exit;}
	}
$myItem = $_POST['myItem'];
$myColour = $_POST['myColour'];
$myMeme = $_POST['myMeme'];    
$myAddress = $_POST['myAddress'];
$myComments = $_POST['myComments'];
$username = $_SESSION['sess_user'];

// echo $username;
$query1 = "SELECT UserID FROM users WHERE Username = '$username'";
$result1 = $dbcnx->query($query1);

if (!$result1){
    echo "query_failed";
}
else{
    $row1 = $result1->fetch_assoc();
    $ID = $row1['UserID'];
    echo $ID;
    $query2 = "INSERT INTO memologyIt (UserID, ItemName, Colour, ImageUploaded, DeliveryAddress, Comments)
            VALUES ($ID,'$myItem','$myColour','$myMeme','$myAddress','$myComments')";
    $result2 = $dbcnx->query($query2);

    if (!$result2){
        echo "Your query failed.";
    } 
    else{
	    echo "Hey ". $username . "! Your application for a " .$myItem. " with a ".$myColour." colour has been submitted!";
    }
}

?>