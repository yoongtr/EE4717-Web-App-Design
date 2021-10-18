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

            $sql="SELECT drinkName, SUM( quantity ) AS totalCount
            FROM case4Orders
            LEFT JOIN case4Drinks ON case4Orders.drinkID = case4Drinks.drinkID
            GROUP BY case4Orders.drinkID";
            $result = $db->query($sql);
            
            if ($result->num_rows > 0) {
              echo '<table><tr><th align="left">Product Name&nbsp;</th><th>&nbsp;Quantity Sold</th></tr>';
                while($row = $result->fetch_assoc()) {
                echo '<tr><td>' .$row["drinkName"]. '&nbsp;</td><td align="center">&nbsp;' .$row["totalCount"]. '</td></tr>'; 
                      
              } 
              echo "</table>";
            }
            else {
                echo "0 results";
              }
            
            $sql_2="SELECT drinkName, SUM( price * quantity ) AS totalSales
            FROM case4Orders
            LEFT JOIN case4Drinks ON case4Orders.drinkID = case4Drinks.drinkID
            GROUP BY case4Drinks.drinkID
            ORDER BY totalSales DESC
            LIMIT 1";
            $result_2 = $db->query($sql_2);

            if ($result_2->num_rows >0){
              while($row_2 = $result_2->fetch_assoc()){
                echo '<p>The top selling item is <strong>' .$row_2["drinkName"]. '</strong> with a total sales of $ <strong>' .$row_2["totalSales"]. '</strong>.</p>';
              }
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