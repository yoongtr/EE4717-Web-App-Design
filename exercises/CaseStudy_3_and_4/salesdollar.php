<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Total Sales Report</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Total Sales Report </h2>
        <?php
            @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

            if (mysqli_connect_errno()) {
                echo "Error: Could not connect to database.  Please try again later.";
                exit;
            }

            $sql="SELECT case4Drinks.drinkID, case4Drinks.drinkName, case4Drinks.price, case4Orders.quantity
            FROM case4Drinks
            LEFT JOIN case4Orders on case4Drinks.drinkID = case4Orders.drinkID
            ORDER BY case4Drinks.drinkID";
            $result = $db->query($sql);
            
            if ($result->num_rows > 0) {
                $subtotalJava = 0;
                $subtotalLaitSingle = 0;
                $subtotalLaitDouble = 0;
                $subtotalCapSingle = 0;
                $subtotalCapDouble = 0;
                $subtotal = 0;
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  
                  $product = $row["drinkID"];
                  if ($product == 1 ){ 
                      $subtotalJava += $row["quantity"] * $row["price"];
                  }
                  elseif($product == 2){
                      $subtotalLaitSingle += $row["quantity"] * $row["price"];
                  }
                  elseif($product == 3){
                    $subtotalLaitDouble += $row["quantity"] * $row["price"];
                }
                  elseif($product == 4){
                    $subtotalCapSingle += $row["quantity"] * $row["price"];
                }
                  elseif($product == 5){
                    $subtotalCapDouble += $row["quantity"] * $row["price"];
                }
                }
                $subtotal = $subtotalJava + $subtotalLaitSingle + $subtotalLaitDouble + $subtotalCapSingle + $subtotalCapDouble;
                echo "<table><tr><th>Product Name&nbsp;</th><th>&nbsp;Sales</th></tr>";
                echo "<tr><td>Just Java </td> <td>&nbsp;" .$subtotalJava. "</td></tr>";
                echo "<tr><td>Single Shot Cafe au Lait&nbsp;</td> <td>&nbsp;" .$subtotalLaitSingle. "</td></tr>";
                echo "<tr><td>Double Shot Cafe au Lait&nbsp;</td> <td>&nbsp;" .$subtotalLaitDouble. "</td></tr>";
                echo "<tr><td>Single Shot Iced Cappucino&nbsp;</td> <td>&nbsp;" .$subtotalCapSingle. "</td></tr>";
                echo "<tr><td>Double Shot Iced Cappucino&nbsp;</td> <td>&nbsp;" .$subtotalCapDouble. "</td></tr>";             
                echo "<tr><td><strong>Sum</strong>&nbsp;</td> <td>&nbsp;<strong>" .$subtotal. "</strong></td></tr>";
                echo "</table>";
              } 
            else {
                echo "0 results";
              }

            $db->close();
        ?>
        <br>
        <a href="salesreport.html">Back to Sales Report</a>
    </body>
</html>