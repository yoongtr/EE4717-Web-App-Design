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
    $query2 = "INSERT INTO memologyIt (UserID, ItemName, Colour, ImageUploaded, DeliveryAddress, Comments)
            VALUES ($ID,'$myItem','$myColour','$myMeme','$myAddress','$myComments')";
    $result2 = $dbcnx->query($query2);

    if (!$result2){
        echo "Your query failed.";
    } 
    else{
?>
<!DOCTYPE html>
<!-- Changed relevant links to my-cart.html and join-us.html and login.html-->
<html lang="en">
    <head>
        <title>Successful Application | Memeology</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <nav>
                    <a href="index.php" id="header-logo">Memeology</a>
                    <a href="products.php?productfilter=Trending">Trending</a>
                    <a href="products.php?productfilter=Sale">SALE</a>
                    <a href="products.php?productfilter=All">Products</a>
                    <a href="memeology-it.php">Submit Your Design!</a>
                    <div class="search-container">
                        <form method="post" action="searchresults.php">
                            <input type="text" placeholder="Search..." name="SearchBar">
                            <button type="submit"><img src="./img/search_button.png" alt="search button" width="15" height="15"></button>
                        </form>
                    </div>
                    <div class="account-info">
                        <a href="my-cart.php"><img src="img/cart-icon-28356.png" width="30" height="30"></a> 
                        <a href="login-main.php"><img src="img/user-icon.png" width="30" height="30"></a>
                    </div>
                </nav>
            </header>
            <div>
                
            </div>
            <div>
                <div class="content">
                    <div class="login-form">
                            <div class="login-form-box">
                                <p>Congratulations <?=$username;?>! Your application for a <?=$myColour;?> <?=$myItem;?> has been recieved!</p>
                                <p> You should be able to see a mail sent to you! </p>
                                <?php
                                $to      = 'f32ee@localhost';
                                $subject = 'Your #MemeologyIt Application has been recieved!';
                                $message = 'Hello '.$username. '. Here are your order details: 1 ' .$myColour. ' colour ' .$myItem. ' to be delivered
                                to ' .$myAddress. '.' ;
                                $headers = 'From: f32ee@localhost' . "\r\n" .
                                    'Reply-To: f32ee@localhost' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();

                                mail($to, $subject, $message, $headers,'-ff32ee@localhost');
                                echo ("Mail sent to : ".$to);
                                ?>
                            </div>
                    </div>
                </div>
                
            </div>
            <footer>
                <hr>
                <div class="row">
                    <div class="column-5">
                        <h3>Memeology</h3>
                        <p>Worldwide meme merchandise store. We sell over 1000+ branded products on our website.</p>
                        <p>Singapore, Singapore</p>
                        <p>+65 1234 5678</p>
                        <p>www.mememology.com</p>
                    </div>
                    <div class="column-5">
                        <h3>Menu</h3>
                        <p><a href="products.php?productfilter=Trending">Trending</a></p>
                        <p><a href="products.php?productfilter=Sale">SALE</a></p>
                        <p><a href="products.php?productfilter=All">Products</a></p>
                        <p><a href="join-us.html">Join Us</a></p>
                    </div>
                    <div class="column-5">
                        <h3>Account</h3>
                        <p><a href="login-main.php">My Account</a></p>
                        <p><a href="my-cart.php">Checkout</a></p>
                        <p><a href="my-cart.php">My Cart</a></p>
                        <p><a href="index.php">My Wishlist</a></p>
                    </div>
                    <div class="column-5">
                        <h3>Folow Us</h3>
                        <p><a href="index.php">Facebook</a></p>
                        <p><a href="index.php">Instagram</a></p>
                        <p><a href="index.php">Twitter</a></p>
                    </div>
                    <div class="column-5">
                        <h3>Stay Connected</h3>
                        <form>
                            <input type="text" placeholder="Enter your email" name="email">
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

<?php
    // echo "Hey ". $username . "! Your application for a " .$myItem. " with a ".$myColour." colour has been submitted!";
    }
}
?>