<!DOCTYPE html>
<!-- Changed relevant links to my-cart.html and join-us.html and login.html-->
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
                    <a href="index.php" id="header-logo">Memeology</a>
                    <a href="products.php?productfilter=Trending">Trending</a>
                    <a href="products.php?productfilter=Sale">SALE</a>
                    <a href="products.php?productfilter=All">Products</a>
                    <a href="memeology-it.php">Submit Your Design!</a>
                    <div class="search-container">
                        <form>
                          <input type="text" placeholder="Search..." name="search">
                          <button type="submit"><img src="./img/search_button.png" alt="search button" width="15" height="15"></button>
                        </form>
                    </div>
                    <div class="account-info">
                        <a href="index.php"><img src="img/wishlist.png" width="30" height="30"></a>
                        <a href="my-cart.php"><img src="img/cart-icon-28356.png" width="30" height="30"></a> 
                        <a href="login-main.php"><img src="img/user-icon.png" width="30" height="30"></a>
                    </div>
                </nav>
            </header>
            <div>
                
            </div>
            <div>
                <div class="content">
                    <div class="join-us-header">
                        <h1>Start your career with the Memeology Team!</h1>
                        <p>We don't bite:)</p>
                    </div>
                    <div class="join-us-form">
                        <form>
                            <div class="join-us-form-box">
                                <div class="inputBox w50">
                                  <input type="text" id="Name" name="Name" required>
                                  <span>First Name</span>
                                </div>
                                <div class="inputBox w50">
                                  <input type="text" id="lastName" name="Last Name" required>
                                  <span>Last Name</span>
                                </div>
                                <div class="inputBox w50">
                                  <input type="email" id="email" name="Email" required>
                                  <span>Email Address</span>
                                </div>
                                <div class="inputBox w50">
                                  <input type="number" id="number" name="Number" required>
                                  <span>Mobile Number</span>
                                </div>
                                <div class="inputBox w50">
                                    <input type="text" id="subject" name="subject" required>
                                    <span>Subject</span>
                                  </div>
                                <div class="inputBox w100">
                                  <textarea id="Message" name="Message" required></textarea>
                                  <span>Message (including work experience here)</span>
                                </div>  
                              </div>
                              <div class="inputBox w100">
                                <input type="submit" id="form-submit" value="Submit Application">
                              </div>
                              <div id="msgSubmit" class="h3 text-center hidden"></div>
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
                        <p><a href="memeology-it.php">MemeologyIt</a></p>
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