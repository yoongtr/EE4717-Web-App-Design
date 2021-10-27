<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
    include "dbconnect.php";
    if (isset($_GET['productfilter'])) {
        $_SESSION['productfilter'] = $_GET['productfilter'];
        };
    if (!isset($_SESSION['cart_item'])){
        $_SESSION['cart_item'] = array();
        };
    if(isset($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["Quantity"])) {
                    $productBySKU = $dbcnx->query("SELECT * FROM products WHERE ProductSKU='" . $_GET["ProductSKU"] . "'");
                    $productBySKU_row = $productBySKU->fetch_assoc();
                    $itemArray = array($productBySKU_row["ProductSKU"]=>array('ProductName'=>$productBySKU_row["ProductName"], 'ProductSKU'=>$productBySKU_row["ProductSKU"], 'Quantity'=>$_POST["Quantity"]));
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productBySKU_row["ProductSKU"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productBySKU_row["ProductSKU"] == $k) {
                                        if(empty($_SESSION["cart_item"][$k]["Quantity"])) {
                                            $_SESSION["cart_item"][$k]["Quantity"] = 0;
                                        }
                                        $_SESSION["cart_item"][$k]["Quantity"] += $_POST["Quantity"];
                                    }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["ProductSKU"] == $k)
                                unset($_SESSION["cart_item"][$k]);				
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
            break;	
        }
        header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
        exit();
    }
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
                    <h2><small><a href="logout.php">Logout</a><small></h2>
                    <div class="my-cart">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Item Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($_SESSION["cart_item"] as $item=>$value){
                                    $productSKU = $item;
                                    $quantity = $value["Quantity"];
                                    $sql = "SELECT *
                                    FROM products
                                    WHERE ProductSKU='$productSKU'";
                                    $result = $dbcnx->query($sql);
                                    if (!$result){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row = $result->fetch_assoc();
                                        $subtotal = $quantity*$row['Price'];
                                        echo "<tr>";
                                        echo "<td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:10vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td>";
                                        echo "<td>" .$row['ProductName']. "</td>";
                                        echo "<td>$";
                                        echo $row['Price']. "</td>";
                                        echo "<td>" .$quantity. "</td>";
                                        echo "<td>$";
                                        echo number_format($subtotal, 2). "</td>";
                                        echo "<td><a href='" .$_SERVER['PHP_SELF']. '?action=remove&ProductSKU=' .$row['ProductSKU']. "'>Remove</a></td>";
                                        echo "</tr>";
                                        $total = $total + $row['Price'];
                                    };
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align='right'></th><br>
                                    <th align='right'></th><br>
                                    <th align='right'></th><br>
                                    <th align='right'>Total:</th><br>
                                    <th align='right'>$<?php echo number_format($total, 2) ?></th><br>
                                    <th align='right'></th><br>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="mycart-right">
                            <br>
                            <form action="checkout.php" method="post">
                                <input type="submit" name="checkout" id="checkout" value="Checkout">
                            </form>
                            <p><a href="products.php">Continue Shopping</a> or
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1">Empty your cart</a></p>
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