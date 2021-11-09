<?php   
session_start();
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
        <title>Products | Memeology</title>
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
                            if ($_SESSION['productfilter']=="All") {
                                $sql = "SELECT *
                                FROM products";
                            }
                            elseif ($_SESSION['productfilter']=="T-Shirt") {
                                $sql = "SELECT *
                                FROM products
                                WHERE ProductCategory= 'T-Shirt' ";
                            }
                            elseif ($_SESSION['productfilter']=="Mug") {
                                $sql = "SELECT *
                                FROM products
                                WHERE ProductCategory= 'Mug' ";
                            }
                            elseif ($_SESSION['productfilter']=="Cover") {
                                $sql = "SELECT *
                                FROM products
                                WHERE ProductCategory= 'Cover' ";
                            }
                            elseif ($_SESSION['productfilter']=="Other") {
                                $sql = "SELECT *
                                FROM products
                                WHERE ProductCategory= 'Other' ";
                            }
                            elseif ($_SESSION['productfilter']=="Trending") {
                                $sql = "SELECT *
                                FROM products
                                WHERE Trending=TRUE ";
                            }
                            elseif ($_SESSION['productfilter']=="Sale") {
                                $sql = "SELECT *
                                FROM products
                                WHERE Sale=TRUE";
                            }
                            elseif ($_SESSION['productfilter']=="SpecialCollection") {
                                $sql = "SELECT *
                                FROM products
                                WHERE SpecialCollection=TRUE";
                            }
                            else {
                                $productSKU = $_SESSION['productfilter'];
                                $sql = "SELECT *
                                FROM products
                                WHERE ProductSKU LIKE '%$productSKU%'";
                            };

                            $result = $dbcnx->query($sql);
                            if (!$result){
                                echo "<h2>Unable to find product(s).</h2>";
                            }
                            else{
                                $row = $result->fetch_assoc();
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
                            <?php echo count($_SESSION['cart_item']); ?> 
                            item(s).</p>
                        <p><a href="my-cart.php">View My Cart</a></p>
                            <table class="product-table">
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Price (SGD)</th>
                                <th>Qty in Stock</th>
                                <th>Add To Cart</th>
                            </tr>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row["ProductSKU"]; ?>">
                                <?php echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['Quantity'] . "</td><td><input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/></td></tr>";?>
                            </form>
                                <?php while($row = $result->fetch_assoc()){?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row["ProductSKU"]; ?>">
                                <?php echo "<tr><td>" . $row['ProductName'] . "</td><td>" . '<img src="data:image/jpeg;base64,'.base64_encode($row['ProductImage']).'" style="width:15vw; height: 200px; object-fit: cover; max-width: 100%;"/>' . "</td><td>" . $row['ProductDescription'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['Quantity'] . "</td><td><input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/></td></tr>";?>
                                </form>
                            <?php }?>
                            </table>
                        <?php
                        };
                        ?>
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