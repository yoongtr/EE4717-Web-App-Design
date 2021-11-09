<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login-main.php");  
} else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Account | Memeology</title>
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
                    <h2>Account Details for <?=$_SESSION['sess_user'];?><br><small><a href="logout.php">Logout</a></small></h2>
                    <div class="my-account">
                        <div class="my-account-details">
                            <?php
                            include "dbconnect.php";
                            $userid = $_SESSION["sess_user_id"];
                            $query = "SELECT FirstName, LastName, Email, isAdmin FROM users WHERE UserID = '$userid'";
                            $result = $dbcnx->query($query);
                            if (!$result){
                                echo "query_failed";
                            }
                            else{
                                $row = $result->fetch_assoc();
                                if ($row['isAdmin']==TRUE) {
                                    echo "<h2>You are admin. View <a href='admin-page.php'>Admin Page.</a></h2>";
                                };
                                echo "<p><strong>First Name: </strong>" .$row["FirstName"]. "</p>";
                                echo "<p><strong>Last Name: </strong>" .$row["LastName"]. "</p>";
                                echo "<p><strong>Email: </strong>" .$row["Email"]. "</p>";
                                echo "<p><strong>Purchase history: </strong></p>";
                            }
                            $history_sql = "SELECT OrderID, OrderDate, orders.ProductSKU, ProductName, ProductImage, ProductDescription, Price, OrderQuantity, (Price * OrderQuantity) AS Subtotal
                            FROM orders LEFT JOIN products
                            ON orders.ProductSKU =  products.ProductSKU
                            WHERE orders.UserID = '$userid'";
                            $result_history = $dbcnx->query($history_sql);
                            if (!$result_history){
                                echo "query_failed";
                            }
                            else{
                                $row_history = $result_history->fetch_assoc();
                                if (count($row_history)==0) {
                                    echo "<p>No transaction history.</p>";
                                }
                                else {
                            ?>
                            <table class="product-table">
                            <tr>
                                <th>OrderID</th>    
                                <th>Date</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Item Price (SGD)</th>
                                <th>Quantity</th>
                                <th>Subtotal (SGD)</th>
                            </tr>
                            <?php
                                    echo "<tr><td>" .$row_history['OrderID']. "</td>";
                                    echo "<td>" .$row_history['OrderDate']. "</td>";
                                    echo "<td>" .$row_history['ProductName']. "</td>";
                                    echo "<td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row_history['ProductImage']).'" style="width:10vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td>";
                                    echo "<td>" .$row_history['ProductDescription']. "</td>";
                                    echo "<td>$" .number_format($row_history['Price'], 2). "</td>";
                                    echo "<td>" .$row_history['OrderQuantity']. "</td>";
                                    echo "<td>$" .number_format($row_history['Subtotal'], 2). "</td></tr>";
                                    while($row_history = $result_history->fetch_assoc()) {
                                        echo "<tr><td>" .$row_history['OrderID']. "</td>";
                                        echo "<td>" .$row_history['OrderDate']. "</td>";
                                        echo "<td>" .$row_history['ProductName']. "</td>";
                                        echo "<td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row_history['ProductImage']).'" style="width:10vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td>";
                                        echo "<td>" .$row_history['ProductDescription']. "</td>";
                                        echo "<td>$" .number_format($row_history['Price'], 2). "</td>";
                                        echo "<td>" .$row_history['OrderQuantity']. "</td>";
                                        echo "<td>$" .number_format($row_history['Subtotal'], 2). "</td></tr>";
                                    };
                                };
                            };
                            ?>
                            </table>
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
}
?>