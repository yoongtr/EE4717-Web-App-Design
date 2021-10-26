<?php   
session_start();
if (isset($_GET['productfilter'])) {
    $_SESSION['productfilter'] = $_GET['productfilter'];
    };
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    };
if (isset($_GET['buy'])) {
    $_SESSION['cart'][] = $_GET['buy'];
    header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
    exit();
    };
?>
<!DOCTYPE html>
<!-- Changed relevant links to my-cart.html and join-us.html and login.html-->
<html lang="en">
    <head>
        <title>Memeology</title>
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
                <!-- <p><?php var_dump($_SESSION); ?></p> -->
                <!-- <p><?php echo $_SESSION['productfilter']=='Sale'; ?></p> -->
                <div class="product-leftcol">
                    <div class="product-filternav">
                    <h4>Filter Product By</h4>
                    <ul>
                        <li><a href="products.php?productfilter=All">All Products</a></li>
                        <li><a href="products.php?productfilter=Sale">SALE</a></li>
                        <li><a href="products.php?productfilter=Trending">Trending</a></li>
                        <li><a href="products.php?productfilter=SpecialCollection">Special Collection</a></li>
                        <li><a href="products.php?productfilter=Cover">Cover</a></li>
                        <li><a href="products.php?productfilter=Mug">Mug</a></li>
                        <li><a href="products.php?productfilter=T-Shirt">T-Shirt</a></li>
                        <li><a href="products.php?productfilter=Other">Other</a></li>
                    </ul>
                    </div>
                </div>
                <div class="product-rightcol">
                    <div class="content">
                    <?php
                            include "dbconnect.php";
                            if ($_SESSION['productfilter']=="All") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products";
                            }
                            elseif ($_SESSION['productfilter']=="T-Shirt") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE ProductCategory= 'T-Shirt' ";
                            }
                            elseif ($_SESSION['productfilter']=="Mug") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE ProductCategory= 'Mug' ";
                            }
                            elseif ($_SESSION['productfilter']=="Cover") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE ProductCategory= 'Cover' ";
                            }
                            elseif ($_SESSION['productfilter']=="Other") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE ProductCategory= 'Other' ";
                            }
                            elseif ($_SESSION['productfilter']=="Trending") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE Trending=TRUE ";
                            }
                            elseif ($_SESSION['productfilter']=="Sale") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE Sale=TRUE";
                            }
                            elseif ($_SESSION['productfilter']=="SpecialCollection") {
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                FROM products
                                WHERE SpecialCollection=TRUE";
                            }
                            else {
                                $productSKU = $_SESSION['productfilter'];
                                $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
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
                            };
                        ?>
                        <h2>Showing result(s) for
                        <?php
                            if ($_SESSION['productfilter']=="All") {
                                echo $_SESSION['productfilter'];
                                echo ' Products';
                            }
                            elseif ($_SESSION['productfilter']=="T-Shirt") {
                                echo $_SESSION['productfilter'];
                            }
                            elseif ($_SESSION['productfilter']=="Mug") {
                                echo $_SESSION['productfilter'];
                            }
                            elseif ($_SESSION['productfilter']=="Cover") {
                                echo $_SESSION['productfilter'];
                            }
                            elseif ($_SESSION['productfilter']=="Other") {
                                echo $_SESSION['productfilter'];
                            }
                            elseif ($_SESSION['productfilter']=="Trending") {
                                echo $_SESSION['productfilter'];
                                echo ' Products';
                            }
                            elseif ($_SESSION['productfilter']=="Sale") {
                                echo $_SESSION['productfilter'];
                                echo ' Products';
                            }
                            elseif ($_SESSION['productfilter']=="SpecialCollection") {
                                echo ' Memeology x Louvre Fashion Collection';
                            }
                            else {
                                echo $row['ProductName'];
                            };
                        ?>
                        </h2>
                        <p>Your shopping cart contains 
                            <?php echo count($_SESSION['cart']); ?> 
                            items.</p>
                        <p><a href="my-cart.php">View My Cart</a></p>
                        <table class="product-table">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price (SGD)</th>
                            <th>Add To Cart</th>
                        </tr>
                        <?php
                            echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td><a href='" .$_SERVER['PHP_SELF']. '?buy=' .$row['ProductSKU']. "'><img src='img/cart-icon-28356.png' width='30' height='30'></a></td></tr>";
                            while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
                                echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td><a href='" .$_SERVER['PHP_SELF']. '?buy=' .$row['ProductSKU']. "'><img src='img/cart-icon-28356.png' width='30' height='30'></a></td></tr>";
                                }
                        ?>
                        </table>
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