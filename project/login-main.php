<?php   
session_start();  
if(isset($_SESSION["sess_user"])){  
    header("location:my-account.php");  
} else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login | Memeology</title>
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
                        <form method="post" action="searchresults.php" name="searchForm" onsubmit="return formSearch()">
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
                        <form action="login.php" method="post" name="loginForm" onsubmit="return formCheck()">
                            <div class="login-form-box">
                                <div class="login-form-input">
                                  <label for="Username">Username:</label>
                                  <input type="text" id="username" name="username">
                                </div>
                                <div class="login-form-input">
                                  <label for="Password">Password:</label>
                                  <input type="password" id="password" name="password">
                                </div>
                                <div class="login-form-submit">
                                    <input type="submit" name="login" id="login" value="Login">
                                </div> <br> 
                                <div><a href="register.html">Register if you don't have an account</a></div> 
                            </div>
                        </form>
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
                        <form action="subscribe.php" method="POST" name="subForm" onsubmit="return formSubmit()">
                            <input type="text" placeholder="Enter your email" name="subEmail" id="subEmail">
                            <button type="submit" name="submit" id="submit">Submit</button>
                            <script type="text/javascript" src="subscribe.js"></script>
                        </form>
                    </div>
                </div>
            </footer>
        </div>
        <script>
            function formCheck(){
                var username = document.forms["loginForm"]["username"].value;
                var password = document.forms["loginForm"]["password"].value;
                if (username == "") {
                    alert("Username cannot be empty!"); 
                    return false;
                }
                else if (password == ""){
                    alert("Password cannot be empty!");
                    return false;
                }
            }
            function formSubmit(){
                var subEmail = document.forms["subForm"]["subEmail"].value;
                if (subEmail == "") {
                    alert("Email cannot be empty!"); 
                    return false;
                }
            }
            function formSearch(){
                var search = document.forms["searchForm"]["SearchBar"].value;
                if (search == "") {
                    alert("Search cannot be empty"); 
                    return false;
                }
            }
        </script>
    </body>
</html>
<?php
}
?>