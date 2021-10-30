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
// echo var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home | Memeology</title>
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
                        <form method="post" action="searchresults.php">
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
                <div class="content">
                    <div>
                        <!-- Slideshow container -->
                        <div class="slideshow-container">
                            <!-- Full-width images with number and caption text -->
                            <div class="mySlides">
                                <a href="products.php?productfilter=005_PepeShirt_S"><img src="./img/slideshow-1.png" style="width:100%"></a>
                            </div>
                        
                            <div class="mySlides">
                                <a href="products.php?productfilter=012_DuckShirt"><img src="./img/slideshow-2.png" style="width:100%"></a>
                            </div>
                        
                            <div class="mySlides">
                                <a href="products.php?productfilter=002_YesPlsMug"><img src="./img/slideshow-3.png" style="width:100%"></a>
                            </div>
                        
                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                        <br>
                        <!-- The dots/circles -->
                        <div style="text-align:center">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                        </div>
                        <script type="text/javascript" src="homeSlideshow.js"></script>
                    </div>
                    <div class="home-desc home-row">
                        <div class="column-4">
                            <img src="./img/home-trophyicon.png" width="50" height="50">
                            <h4>High Quality</h4>
                            <p>Vegan-friendly, non-allergic materials</p>
                        </div>
                        <div class="column-4">
                            <img src="./img/home-check.png" width="50" height="50">
                            <h4>Return / Refund</h4>
                            <p>Within 15 days purchase</p>
                        </div>
                        <div class="column-4">
                            <img src="./img/home-handbox.png" width="50" height="50">
                            <h4>Free Shipping</h4>
                            <p>For orders over $50</p>
                        </div>
                        <div class="column-4">
                            <img src="./img/home-support.png" width="50" height="50">
                            <h4>DIY Style</h4>
                            <p>Design your own merch!</p>
                        </div>
                    </div>
                    <div class="home-row">
                        <h2>Latest Trend - Summer 2021!</h2>
                        <div class="home-row">
                            <table border="0" class="home-table">
                                <tr class="row-1">
                                    <td>
                                    <?php
                                    include "dbconnect.php";
                                    $sql0 = "SELECT * 
                                    FROM products
                                    WHERE ProductSKU = '001_Fan' ";
                                    $result0 = $dbcnx->query($sql0);
                                    // echo $result;
                                    if (!$result0){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row0 = $result0->fetch_assoc();
                                        echo '<a href="products.php?productfilter=001_Fan"><img src="data:image/jpeg;base64,'.base64_encode($row0['ProductImage']).'" style="width:25vw; height: 500px; object-fit: cover; max-width: 100%;"/></a>';
                                    };
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                    $sql1 = "SELECT * 
                                    FROM products
                                    WHERE ProductSKU = '005_PepeShirt_S' ";
                                    $result1 = $dbcnx->query($sql1);
                                    // echo $result;
                                    if (!$result1){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row1 = $result1->fetch_assoc();
                                        echo '<a href="products.php?productfilter=005_PepeShirt_S"><img src="data:image/jpeg;base64,'.base64_encode($row1['ProductImage']).'" style="width:25vw; height: 500px; object-fit: cover; max-width: 100%;"/></a>';
                                    };
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                    $sql2 = "SELECT * 
                                    FROM products
                                    WHERE ProductSKU = '009_WomenCat' ";
                                    $result2 = $dbcnx->query($sql2);
                                    // echo $result;
                                    if (!$result2){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row2 = $result2->fetch_assoc();
                                        echo '<a href="products.php?productfilter=009_WomenCat"><img src="data:image/jpeg;base64,'.base64_encode($row2['ProductImage']).'" style="width:25vw; height: 500px; object-fit: cover; max-width: 100%;"/></a>';
                                    };
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                    $sql3 = "SELECT * 
                                    FROM products
                                    WHERE ProductSKU = '006_FineMug' ";
                                    $result3 = $dbcnx->query($sql3);
                                    // echo $result;
                                    if (!$result3){
                                        echo "query_failed";
                                    }
                                    else{
                                        $row3 = $result3->fetch_assoc();
                                        echo '<a href="products.php?productfilter=006_FineMug"><img src="data:image/jpeg;base64,'.base64_encode($row3['ProductImage']).'" style="width:25vw; height: 500px; object-fit: cover; max-width: 100%;"/></a>';
                                    };
                                    ?>
                                    </td>
                                </tr>
                                <tr class="row-2">
                                    <td class="home-desc">
                                        <h4>
                                            <strong>
                                            <a href="products.php?productfilter=001_Fan">
                                            <?php
                                            echo $row0['ProductName'];
                                            if ($row0['Sale']) {
                                                echo ' [SALE!!!]';
                                            };
                                            ?>
                                            </a>
                                            </strong>
                                        </h4>
                                        <p><small>
                                            <?php
                                            echo $row0['ProductDescription'];
                                            ?>
                                        </small></p>
                                        <p>
                                            SGD $
                                            <?php
                                            echo $row0['Price'];
                                            ?>
                                        </p>
                                    </td>
                                    <td class="home-desc">
                                        <h4>
                                            <strong>
                                            <a href="products.php?productfilter=005_PepeShirt_S">
                                            <?php
                                            echo $row1['ProductName'];
                                            if ($row1['Sale']) {
                                                echo ' [SALE!!!]';
                                            };
                                            ?>
                                            </a>
                                            </strong>
                                        </h4>
                                        <p><small>
                                            <?php
                                            echo $row1['ProductDescription'];
                                            ?>
                                        </small></p>
                                        <p>
                                            SGD $
                                            <?php
                                            echo $row1['Price'];
                                            ?>
                                        </p>
                                    </td>
                                    <td class="home-desc">
                                        <h4>
                                            <strong>
                                            <a href="products.php?productfilter=009_WomenCat">
                                            <?php
                                            echo $row2['ProductName'];
                                            if ($row2['Sale']) {
                                                echo ' [SALE!!!] ';
                                            };
                                            ?>
                                            </a>
                                            </strong>
                                        </h4>
                                        <p><small>
                                            <?php
                                            echo $row2['ProductDescription'];
                                            ?>
                                        </small></p>
                                        <p>
                                            SGD $
                                            <?php
                                            echo $row2['Price'];
                                            ?>
                                        </p>
                                    </td>
                                    <td class="home-desc">
                                        <h4>
                                            <strong>
                                            <a href="products.php?productfilter=006_FineMug">
                                            <?php
                                            echo $row3['ProductName'];
                                            if ($row3['Sale']) {
                                                echo ' [SALE!!!]';
                                            };
                                            ?>
                                            </a>
                                            </strong>
                                        </h4>
                                        <p><small>
                                            <?php
                                            echo $row3['ProductDescription'];
                                            ?>
                                        </small></p>
                                        <p>
                                            SGD $
                                            <?php
                                            echo $row3['Price'];
                                            ?>
                                        </p>
                                        <p>
                                            
                                        </p>
                                    </td>
                                </tr>
                                <tr class="row-2">
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row0["ProductSKU"]; ?>">
                                            <?php echo "<input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/>";?>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row1["ProductSKU"]; ?>">
                                            <?php echo "<input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/>";?>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row2["ProductSKU"]; ?>">
                                            <?php echo "<input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/>";?>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=add&ProductSKU=<?php echo $row3["ProductSKU"]; ?>">
                                            <?php echo "<input type='number' min='1' name='Quantity' value='1' size='2' /><input type='submit' value='Add to Cart'/>";?>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <button onclick="window.location.href='products.php?productfilter=Trending'">Explore More</button>
                        </div>
                    </div>
                    <div class="home-row featured">
                        <div class="column left">
                            <h2>Featured collections</h2>
                            <p>Memeology x Louvre Fashion collection.</p>
                            <p>Exclusive pricings for members.</p>
                            <button onclick="window.location.href='products.php?productfilter=SpecialCollection'">Explore More</button>
                        </div>
                        <div class="column right">
                            <img src="./img/home-featured.png">
                        </div>
                    </div>
                    <div class="home-row memeologyit">
                        <p>create your own merch designs with</p>
                        <h2><a href="memeology-it.php">#MemeologyIt</a></h2>
                        <a href="memeology-it.php"><img src="./img/memeologyit.png"></a>
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
                        <form action="subscribe.php" method="POST">
                            <input type="text" placeholder="Enter your email" name="subEmail" id="subEmail">
                            <button type="submit" name="submit" id="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>