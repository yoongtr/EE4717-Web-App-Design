<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
?>
<!DOCTYPE html>
<!-- Changed relevant links to my-cart.html and join-us.html and login.html-->
<html lang="en">
    <head>
        <title>Memeology It | Memeology</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
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
                    <div class="memeology-header">
                        <h1>#MemeologyIt</h1>
                        <p>Why be normal when you can be a meme god</p>
                        <!-- <img src="./img/memeologyit.png"> -->
                    </div>
                    <div class="memeology-form">
                        <form action="memeology-submit.php" method="POST">
                            <div class="memeology-form-details">
                                <div class="memeology-selections">
                                    <div class="memeology-item options">
                                        <select name="myItem" id="myItem">
                                            <option value="">Pick an Item</option>  
                                            <option value="T-Shirt">T-Shirt</option>
                                            <option value="Mug">Mug</option>
                                            <option value="Mousepad">Mousepad</option>
                                        </select>
                                    </div>
                                    <div class="memeology-colours options">
                                        <select name="myColour" id="myColour">
                                            <option value="">Choose a Colour</option>  
                                            <option value="Red">Red</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Green">Green</option>
                                        </select>
                                    </div>
                                    <div class="memeology-meme options">
                                        <input type="file" id="myMeme" name="myMeme">
                                    </div>
                                </div>
                                <div class="memeology-price">
                                    <p>Options Selected</p>
                                    <table>
                                        <tr><td>Choice Price:</td><td id="itemPrice">0</td></tr>
                                        <tr><td>Colour Price:</td><td id="colourChoice">0</td></tr>
                                        <tr><td>Total Price:</td><td id="totalPrice">0</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="memeology-address">
                                <textarea id="myAddress" name="myAddress" required placeholder="Please Input Address"></textarea>
                            </div>
                            <div class="memeology-comments">
                                <textarea id="myComments" name="myComments" required placeholder="Any Additional Comments"></textarea>
                            </div>
                            <div class="submitbutton">
                               <input type="submit" id="submit" name="submit" value="Submit Application">
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
        <script>
             var pricing = "0"
             var colouring = "0";
             total = 0;
            function checkPrice(){
                var itemSelec = document.querySelector('select[id="myItem"]');
                itemSelec = itemSelec.value;
                if (itemSelec == "T-Shirt"){
                    pricing = "15.00";
                }
                else if(itemSelec == "Mug"){
                    pricing = "5.00";
                }
                else if(itemSelec == "Mousepad"){
                    pricing = "10.00";
                }              
                document.getElementById("itemPrice").innerHTML = "$ " + pricing;
                total = parseFloat(pricing)+ parseFloat(colouring)     ;
                total = String(total);
                document.getElementById("totalPrice").innerHTML = "$ " + total;
            }
            function checkColour(){
                var colourSelec = document.querySelector('select[id="myColour"]');
                colourSelec = colourSelec.value;
                
                if (colourSelec == "Red" ){
                    colouring = "2.50";
                }
                else if(colourSelec == "Green"){
                    colouring = "3.00";
                }
                else if(colourSelec == "Blue"){
                    colouring = "3.50";
                }
                document.getElementById("colourChoice").innerHTML = "$ " + colouring;
                total = parseFloat(colouring) + parseFloat(pricing) ;
                total = String(total);
                document.getElementById("totalPrice").innerHTML = "$ " + total;
            }
            var items = document.getElementById("myItem");
            var colours = document.getElementById("myColour");
            items.addEventListener("change", checkPrice, false);
            colours.addEventListener("change", checkColour, false);
        </script>
    </body>
</html>
<?php
}
?>