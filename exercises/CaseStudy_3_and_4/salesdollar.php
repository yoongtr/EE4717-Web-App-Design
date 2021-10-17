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

            $sql="SELECT drinkName, SUM(price * quantity) AS totalSales FROM case4Orders
                  LEFT JOIN case4Drinks ON case4Orders.drinkID = case4Drinks.drinkID
                  GROUP BY case4Drinks.drinkID";
            $result = $db->query($sql);
            
            if ($result->num_rows > 0) {
              echo '<table><tr><th align="left">Product Name&nbsp;</th><th>&nbsp;Sales($)</th></tr>';
                while($row = $result->fetch_assoc()) {
                echo '<tr><td>' .$row["drinkName"]. '&nbsp;</td><td align="center">&nbsp;' .$row["totalSales"]. "</td></tr>"; 
                     
              } 
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