<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
?>
<!DOCTYPE html>
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
                    <div class="memeology-header">
                        <h1>#MemeologyIt</h1>
                        <p>Why be normal when you can be a meme god</p>
                        <img src="./img/memeologyit.png">
                    </div>
                    <div class="memeology-form">
                        <form action="memeology-submit.php" method="POST" name="memeologyForm" onsubmit="return formCheck()">
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
                                    <p><strong>Options Selected</strong></p>
                                    <table>
                                        <tr><td>Choice Price:</td><td id="itemPrice">0</td></tr>
                                        <tr><td>Colour Price:</td><td id="colourChoice">0</td></tr>
                                        <tr><td>Total Price:</td><td id="totalPrice">0</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="memeology-address">
                                <textarea id="myAddress" name="myAddress" placeholder="Please Input Address"></textarea>
                            </div>
                            <div class="memeology-comments">
                                <textarea id="myComments" name="myComments" placeholder="Any Additional Comments"></textarea>
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
                var address = document.forms["memeologyForm"]["myAddress"].value;
                var myItem = document.forms["memeologyForm"]["myItem"].value;
                var myColour = document.forms["memeologyForm"]["myColour"].value;
                var myMeme = document.forms["memeologyForm"]["myMeme"].value;
                if (myItem == "") {
                    alert("Please pick an Item!"); 
                    return false;
                }
                else if (myColour == ""){
                    alert("Please pick a Colour!")
                    return false;
                }
                else if (myMeme == ""){
                    alert("Please upload a Meme!")
                    return false;
                }
                else if (address == ""){
                    alert("Please input your Address!")
                    return false;
                }
            }
             var pricing = "0"
             var colouring = "0";
             total = 0;
             function checkPrice(){
                var itemSelec = document.querySelector('select[id="myItem"]');
                itemSelec = itemSelec.value;
                if (itemSelec == "T-Shirt"){
                    pricing = "14.99";
                }
                else if(itemSelec == "Mug"){
                    pricing = "4.99";
                }
                else if(itemSelec == "Mousepad"){
                    pricing = "9.99";
                }              
                document.getElementById("itemPrice").innerHTML = "$ " + pricing;
                total = parseFloat(pricing) + parseFloat(colouring);
                total = String(total);
                document.getElementById("totalPrice").innerHTML = "$ " + total;
            }
            function checkColour(){
                var colourSelec = document.querySelector('select[id="myColour"]');
                colourSelec = colourSelec.value;
                if (colourSelec == "Red" ){
                    colouring = "2.49";
                }
                else if(colourSelec == "Green"){
                    colouring = "2.99";
                }
                else if(colourSelec == "Blue"){
                    colouring = "3.49";
                }
                document.getElementById("colourChoice").innerHTML = "$ " + colouring;
                total = parseFloat(colouring) + parseFloat(pricing) ;
                total = String(total);
                document.getElementById("totalPrice").innerHTML = "$ " + total;
            }
            var items = document.getElementById("myItem");
            var colours = document.getElementById("myColour");
            items.addEventListener("change", checkPrice, true);
            colours.addEventListener("change", checkColour, true);
            
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
                    alert("Search cannot be empty!"); 
                    return false;
                }
            }
        </script>
    </body>
</html>
<?php
}
?>