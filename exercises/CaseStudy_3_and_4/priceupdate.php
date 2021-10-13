
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JavaJam Coffee House</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <img src="img/header.png" id="img" alt="header" width="500">
            </header>
            <div id="leftcolumn">
                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li><br>
                        <li><a href="menu.html">Menu</a></li><br>
                        <li><a href="music.html">Music</a></li><br>
                        <li><a href="jobs.html">Jobs</a></li><br>
                        <li><a href="priceupdate.php" class="active-page">Product<br>Price<br>Update</a></li><br>
                        <li><a href="salesreport.html">Daily<br>Sales<br>Report</a></li><br>
                    </ul>
                </nav>
            </div>
            <div id="rightcolumn">
                <div class="content">
                    <h2>Click to update product prices</h2>
                    <table border="0" id="centered">
                    <form id="update_price">
                        <tr id="table-row-1">
                            <td id="update-checkbox"><input type="checkbox" id="justjava_update" name="justjava_update" onclick='window.location.assign("changeJustJava.html")'></td>
                            <td headers="dish" id="table-leftcol">Just Java</td>
                            <td headers="description" id="table-rightcol">
                                Regular house blend, decaffeinated coffee, or flavour of the day.
                                <br><strong>Endless Cup $</strong>
                                <?php
                                    @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
                                    if (mysqli_connect_errno()) {
                                        echo 'Error: Could not connect to database.  Please try again later.';
                                        exit;
                                    }
                                    $query = "SELECT price FROM case4Drinks where drinkID = 1";
                                    $result = $db->query($query);
                                    $row = $result->fetch_assoc();
                                    echo "<strong>";
                                    echo stripslashes($row['price']);
                                    echo "</strong>";
                                    // $db->close();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="update-checkbox"><input type="checkbox" id="cal_update" name="cal_update" onclick='window.location.assign("changeCaL.html")'></td>
                            <td headers="dish" id="table-leftcol">Cafe au Lait</td>
                            <td headers="description" id="table-rightcol">
                                House blended coffee infused into a smooth, steamed milk.
                                <br><strong>Single $<strong>
                                <?php
                                    $query = "SELECT price FROM case4Drinks where drinkID = 2";
                                    $result = $db->query($query);
                                    $row = $result->fetch_assoc();
                                    echo "<strong>";
                                    echo stripslashes($row['price']);
                                    echo "</strong>";
                                ?>
                                <strong>double $</strong>
                                <?php
                                    $query = "SELECT price FROM case4Drinks where drinkID = 3";
                                    $result = $db->query($query);
                                    $row = $result->fetch_assoc();
                                    echo "<strong>";
                                    echo stripslashes($row['price']);
                                    echo "</strong>";
                                ?>
                            </td>
                        </tr>
                        <tr id="table-row-1">
                            <td id="update-checkbox"><input type="checkbox" id="ic_update" name="ic_update" onclick='window.location.assign("changeIC.html")'></td>
                            <td headers="dish" id="table-leftcol">Iced Cappucino</td>
                            <td headers="description" id="table-rightcol">
                                Sweetened espresso blended withicy-cold milk and served in chilled glass.
                                <br><strong>Single $</strong>
                                <?php
                                    $query = "SELECT price FROM case4Drinks where drinkID = 4";
                                    $result = $db->query($query);
                                    $row = $result->fetch_assoc();
                                    echo "<strong>";
                                    echo stripslashes($row['price']);
                                    echo "</strong>";
                                ?>
                                <strong>Double $</strong>
                                <?php
                                    $query = "SELECT price FROM case4Drinks where drinkID = 5";
                                    $result = $db->query($query);
                                    $row = $result->fetch_assoc();
                                    echo "<strong>";
                                    echo stripslashes($row['price']);
                                    echo "</strong>";
                                    $db->close();
                                ?>
                            </td>
                        </tr>
                    </form>
                    </table>
                </div>
            </div>
            <footer>
                <small><i>Copyright &copy; 2014 JavaJam Coffee House</i></small>
                <br>
                <small><i>By Tran Thuy Dung and Dhruv Shanbag</i></small>
            </footer>
        </div>
    </body>
</html>