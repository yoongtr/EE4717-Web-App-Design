<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.html");  
} else{
?>
<!DOCTYPE html>
<!-- Added My Cart Page -->
<!-- Changed relevant links to my-cart.html and join-us.html-->
<html lang="en">
    <head>
        <title>Memeology</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <nav>
                    <a href="index.html" id="header-logo">Memeology</a>
                    <a href="index.html">Trending</a>
                    <a href="index.html">SALE</a>
                    <a href="index.html">Products</a>
                    <a href="join-us.html">Join Us!</a>
                    <div class="search-container">
                        <form>
                          <input type="text" placeholder="Search..." name="search">
                          <button type="submit"><img src="./img/search_button.png" alt="search button" width="15" height="15"></button>
                        </form>
                    </div>
                    <div class="account-info">
                        <a href="index.html"><img src="img/wishlist.png" width="30" height="30"></a>
                        <a href="my-cart.php"><img src="img/cart-icon-28356.png" width="30" height="30"></a>
                        <a href="login.html"><img src="img/user-icon.png" width="30" height="30"></a>
                    </div>
                </nav>
            </header>
            <div>
                
            </div>
            <div>
                <div class="content">
                    <p>My Cart. Welcome
                    <?=$_SESSION['sess_user'];?>! <a href="logout.php">Logout</a></p>
                    <div class="my-cart">
                        <div class="my-cart-items">
                            Put items
                        </div>
                        <div class="my-cart-total">
                            Put subtotal
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
                        <p><a href="index.html">Trending</a></p>
                        <p><a href="index.html">SALE</a></p>
                        <p><a href="index.html">Products</a></p>
                        <p><a href="join-us.html">Join Us</a></p>
                    </div>
                    <div class="column-5">
                        <h3>Account</h3>
                        <p><a href="index.html">My Account</a></p>
                        <p><a href="index.html">Checkout</a></p>
                        <p><a href="my-cart.php">My Cart</a></p>
                        <p><a href="index.html">My Wishlist</a></p>
                    </div>
                    <div class="column-5">
                        <h3>Folow Us</h3>
                        <p><a href="index.html">Facebook</a></p>
                        <p><a href="index.html">Instagram</a></p>
                        <p><a href="index.html">Twitter</a></p>
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
}
?>