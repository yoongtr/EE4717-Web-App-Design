<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sales Quantities</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Quantity Sold</h2>
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
                $quantityJava = 0;
                $quantityLaitSingle = 0;
                $quantityLaitDouble = 0;
                $quantityCapSingle = 0;
                $quantityCapDouble = 0;
                $quantityTotal = 0;
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  
                  $product = $row["drinkID"];
                  if ($product == 1 ){ 
                      $quantityJava += $row["quantity"];
                  }
                  elseif($product == 2){
                      $quantityLaitSingle += $row["quantity"];
                  }
                  elseif($product == 3){
                    $quantityLaitDouble += $row["quantity"];
                }
                  elseif($product == 4){
                    $quantityCapSingle += $row["quantity"];
                }
                  elseif($product == 5){
                    $quantityCapDouble += $row["quantity"];
                }
                }
                $quantityTotal = $quantityJava + $quantityLaitSingle + $quantityLaitDouble + $quantityCapSingle + $quantityCapDouble;
                echo "<table><tr><th>Product Name&nbsp;</th><th>&nbsp;Quantity</th></tr>";
                echo "<tr><td>Just Java&nbsp;</td> <td>&nbsp;" .$quantityJava. "</td></tr>";
                echo "<tr><td>Single Shot Cafe au Lait&nbsp;</td> <td>&nbsp;" .$quantityLaitSingle. "</td></tr>";
                echo "<tr><td>Double Shot Cafe au Lait&nbsp;</td> <td>&nbsp;" .$quantityLaitDouble. "</td></tr>";
                echo "<tr><td>Single Shot Iced Cappucino&nbsp;</td> <td>&nbsp;" .$quantityCapSingle. "</td></tr>";
                echo "<tr><td>Double Shot Iced Cappucino&nbsp;</td> <td>&nbsp;" .$quantityCapDouble. "</td></tr>";             
                echo "<tr><td><strong>Total Quantity Sold</strong>&nbsp;</td> <td>&nbsp;" .$quantityTotal. "</td></tr>";
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