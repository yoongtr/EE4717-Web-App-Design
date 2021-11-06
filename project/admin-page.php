<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
    include "dbconnect.php";
    $userid = $_SESSION["sess_user_id"];
    $sql_user = "SELECT isAdmin FROM users WHERE UserID='$userid'";
    $result_user = $dbcnx->query($sql_user);
    if (!$result_user){
        echo "<p>Cannot connect to database.</p>";
    }
    else{
        $row_user = $result_user->fetch_assoc();
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
                    <?php 
                    if ($row_user["isAdmin"]==FALSE) {
                        echo "<h2>You are not an admin.</h2>";
                        echo "<h2><a href='my-account.php'>Go back to My Account</a></h2>";
                    }
                    else {
                    ?>
                    <h2>Admin page to update product quantity</h2>
                    <?php
                    $sql = "SELECT *
                    FROM products";
                    $result = $dbcnx->query($sql);
                    if (!$result){
                        echo "<p>Cannot connect to database.</p>";
                    }
                    else{
                        $row = $result->fetch_assoc();
                    
                    ?>
                    <table class="product-table">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price (SGD)</th>
                            <th>Qty in Stock</th>
                            <th>Update Qty</th>
                        </tr>
                        <form method="post" action="admin-page-result.php?adminSKU=<?php echo $row['ProductSKU'];?>">
                                <?php echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['Quantity'] . "</td><td><input type='number' min='1' name='adminQty' value='1' size='2' /><input type='submit' value='Update'/></td></tr>";?>
                        </form>
                        <?php while($row = $result->fetch_assoc()){   //Creates a loop to loop through results?>
                            <form method="post" action="admin-page-result.php?adminSKU=<?php echo $row['ProductSKU'];?>">
                            <?php echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['Quantity'] . "</td><td><input type='number' min='1' name='adminQty' value='1' size='2' /><input type='submit' value='Update'/></td></tr>";?>
                            </form>
                        <?php }?>
                    </table>
                    <?php 
                        }; 
                    };
                    ?>
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
};
};
?>