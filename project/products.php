<?php   
session_start();
if (isset($_GET['productfilter'])) {
    $_SESSION['productfilter'] = $_GET['productfilter'];
    };
?>
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
                <div class="content">
                    <!-- <p><?php var_dump($_SESSION); ?></p> -->
                    <!-- <p><?php echo $_SESSION['productfilter']=='Sale'; ?></p> -->
                    <div>
                        <p>Filter Product By Category</p>
                        <a href="products.php?productfilter=All">All Products</a><br>
                        <a href="products.php?productfilter=Sale">SALE</a><br>
                        <a href="products.php?productfilter=Trending">Trending</a><br>
                        <a href="products.php?productfilter=Cover">Cover</a><br>
                        <a href="products.php?productfilter=Mug">Mug</a><br>
                        <a href="products.php?productfilter=T-Shirt">T-Shirt</a><br>
                        <a href="products.php?productfilter=Other">Other</a><br>
                    </div>
                    <table>
                    <?php
                        include "dbconnect.php";
                        if ($_SESSION['productfilter']=="All") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products";
                        }
                        elseif ($_SESSION['productfilter']=="T-Shirt") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE ProductCategory= 'T-Shirt' ";
                        }
                        elseif ($_SESSION['productfilter']=="Mug") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE ProductCategory= 'Mug' ";
                        }
                        elseif ($_SESSION['productfilter']=="Cover") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE ProductCategory= 'Cover' ";
                        }
                        elseif ($_SESSION['productfilter']=="Other") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE ProductCategory= 'Other' ";
                        }
                        elseif ($_SESSION['productfilter']=="Trending") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE Trending=TRUE ";
                        }
                        elseif ($_SESSION['productfilter']=="Sale") {
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE Sale=TRUE";
                        }
                        else {
                            $productSKU = $_SESSION['productfilter'];
                            $sql = "SELECT ProductName, ProductImage, ProductDescription, Price
                            FROM products
                            WHERE ProductSKU='$productSKU'";
                        };

                        $result = $dbcnx->query($sql);
                        // echo $result;
                        if (!$result){
                            echo "query_failed";
                        }
                        else{
                            $row = $result->fetch_assoc();
                            // echo "<script>console.log($row);</script>";
                            echo "<tr><td>" . $row['ProductName'] . "</td><td>" . 'image' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td></tr>";
                            while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
                                echo "<script>console.log('count');</script>";
                                echo "<tr><td>" . $row['ProductName'] . "</td><td>" . 'image' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td></tr>";
                                }
                        };
                        ?>
                    </table>
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