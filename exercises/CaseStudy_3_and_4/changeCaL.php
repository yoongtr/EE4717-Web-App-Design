<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change Price for Cafe au Lait</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
            $single_price = $_POST['singleprice'];
            $double_price = $_POST['doubleprice'];

            @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

            if (mysqli_connect_errno()) {
                echo "Error: Could not connect to database.  Please try again later.";
                exit;
            }

            // function updateSingle($sgprice) {
            //     $query1 = "UPDATE case4Drinks
            //         SET price = ".$sgprice."
            //         WHERE drinkID = 2";
            //     $result1 = $db->query($query1);
            //     if ($result1) {
            //         echo  $db->affected_rows." Cafe au Lait, Single Shot price changed. <br>";
            //     } else {
            //           echo "An error has occurred.  The price was not changed.";
            //     };
            // };

            // function updateDouble($dbprice) {
            //     $query2 = "UPDATE case4Drinks
            //         SET price = ".$dbprice."
            //         WHERE drinkID = 3";
            //     $result1 = $db->query($query2);
            //     if ($result2) {
            //         echo  $db->affected_rows." Cafe au Lait, Double Shot price changed. <br>";
            //     } else {
            //           echo "An error has occurred.  The price was not changed.";
            //     };
            // };

            if (!$single_price && !$double_price) {
                echo "You have not entered the price.<br />"
                     ."Please go back and try again.";
                exit;
            }
            elseif ($single_price && !$double_price) {
                $query1 = "UPDATE case4Drinks
                SET price = ".$single_price."
                WHERE drinkID = 2";
                $result1 = $db->query($query1);
                if ($result1) {
                    echo  $db->affected_rows." Cafe au Lait, Single Shot price changed. <br>";
                } else {
                      echo "An error has occurred.  The price was not changed.";
                };
                echo "<br><p>";
                echo "No changes were made to Double Shot.";
                echo "</p>";
            }
            elseif (!$single_price && $double_price) {
                $query2 = "UPDATE case4Drinks
                SET price = ".$double_price."
                WHERE drinkID = 3";
                $result2 = $db->query($query2);
                if ($result2) {
                    echo  $db->affected_rows." Cafe au Lait, Double Shot price changed. <br>";
                } else {
                      echo "An error has occurred.  The price was not changed.";
                };
                echo "<br><p>";
                echo "No changes were made to Single Shot.";
                echo "</p>";
            }
            else {
                $query1 = "UPDATE case4Drinks
                SET price = ".$single_price."
                WHERE drinkID = 2";
                $result1 = $db->query($query1);
                if ($result1) {
                    echo  $db->affected_rows." Cafe au Lait, Single Shot price changed. <br>";
                } else {
                      echo "An error has occurred.  The price was not changed.";
                };
                $query2 = "UPDATE case4Drinks
                SET price = ".$double_price."
                WHERE drinkID = 3";
                $result2 = $db->query($query2);
                if ($result2) {
                    echo  $db->affected_rows." Cafe au Lait, Double Shot price changed. <br>";
                } else {
                      echo "An error has occurred.  The price was not changed.";
                };
            }
          
            $db->close();
        ?>
        <br>
        <a href="priceupdate.php">Back to Product Price Update</a>
    </body>
</html>