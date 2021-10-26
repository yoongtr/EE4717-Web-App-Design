<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    };
    if (isset($_GET['empty'])) {
        unset($_SESSION['cart']);
        header('location: ' . $_SERVER['PHP_SELF']);
        exit();
    };
?>
<!DOCTYPE html>
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
                <div class="content">
                    <h2>Viewing
                    <?=$_SESSION['sess_user'];?>'s Cart</h2>
                    <h4><a href="logout.php">Logout</a></h4>
                    <div class="my-cart">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "dbconnect.php";
                                $total = 0;
                                for ($i=0; $i < count($_SESSION['cart']); $i++){
                                    $productSKU = $_SESSION['cart'][$i];
                                    $sql = "SELECT ProductSKU, ProductName, ProductImage, ProductDescription, Price
                                    FROM products
                                    WHERE ProductSKU='$productSKU'";
                                    $result = $dbcnx->query($sql);
                                    if (!$result){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row = $result->fetch_assoc();
                                        echo "<tr>";
                                        echo "<td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:10vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td>";
                                        echo "<td>" .$row['ProductName']. "</td>";
                                        echo "<td align='right'>$";
                                        echo $row['Price']. "</td>";
                                        echo "</tr>";
                                        $total = $total + $row['Price'];
                                    };
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align='right'></th><br>
                                    <th align='right'>Total:</th><br>
                                    <th align='right'>$<?php echo number_format($total, 2) ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <p><a href="products.php">Continue Shopping</a> or
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1">Empty your cart</a></p>
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
<?php
}
?>