<?php   
session_start();
include "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Checkout | Memeology</title>
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
            <div class="content">
                <p>
                <?php
                $checkoutOK = TRUE;
                $userid = $_SESSION['sess_user_id'];
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
                        if ($quantity<$row['Quantity']) {
                            $newQtyInStock = $row['Quantity'] - $quantity;
                            $sql_update = "UPDATE products
                            SET Quantity=$newQtyInStock
                            WHERE ProductSKU='$productSKU'";
                            $result_update = $dbcnx->query($sql_update);
                            if (!$result_update) {
                                echo "An error has occurred. Could not checkout.";
                            }
                            else {
                                $orders_update = "INSERT INTO orders (OrderDate, ProductSKU, UserID, OrderQuantity) VALUES (CURRENT_DATE, '$productSKU', '$userid', '$quantity')";
                                $result_orders_update = $dbcnx->query($orders_update);
                                if (!$result_orders_update) {
                                    echo "Could not update orders table.";
                                }
                            };
                        }
                        else {
                            echo "<br>Only " .$row['Quantity']. " left in stock for <strong>" .$row['ProductName']. "</strong> but you ordered " .$quantity. ".";
                            echo "<br><br>Please <a href='my-cart.php'>go back to cart</a> and review your items.";
                            $checkoutOK = FALSE;
                        };
                    };;
                }
                ?>
                </p>
                <h2>
                    <?php
                    if ($checkoutOK==TRUE) {
                        echo "Checkout Done!";
                        echo "<br><br><a href='index.php'>Continue Shopping</a><br>";
                        
                        $cartTotal = array();
                        foreach ($_SESSION["cart_item"] as $k=>$v){
                            array_push($cartTotal, $k);
                        };
                        $comma_separated = implode(" , ", $cartTotal);
                        $to = 'f32ee@localhost';
                        $subject = 'Your Memeology Order has been confirmed!';
                        $message = 'Hello '.$_SESSION["sess_user"]. '. Here are your order details: ';
                        $message = $message . $comma_separated;
                        $headers = 'From: f32ee@localhost' . "\r\n" .
                        'Reply-To: f32ee@localhost' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                        mail($to, $subject, $message, $headers,'-ff32ee@localhost');
                        echo ("Order Success email sent to : ".$to);
                        unset($_SESSION["cart_item"]);
                    }
                    ?>
                </h2>
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