<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change Price for Just Java</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
            $price = $_POST['jjprice'];
            if (!$price) {
                echo "You have not entered the price.<br />"
                     ."Please go back and try again.";
                exit;
            }

            @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

            if (mysqli_connect_errno()) {
                echo "Error: Could not connect to database.  Please try again later.";
                exit;
            }

            $query = "UPDATE case4Drinks
                    SET price = ".$price."
                    WHERE drinkID = 1";
            $result = $db->query($query);

            if ($result) {
                echo  $db->affected_rows." Just Java price changed.";
            } else {
                  echo "An error has occurred.  The price was not changed.";
            }
          
            $db->close();
        ?>
        <br>
        <a href="priceupdate.php">Back to Product Price Update</a>
    </body>
</html>