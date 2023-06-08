<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Car List to Sell</title>
  </head>
  <body>
    <h2>Car List to Sell</h2>
    <form action="customer_car_sold.php" method="post">
      <?php
        // Database connection details
        include('connectionData.txt');

        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        // Get the customer ID from the previous page
        $customer_id = $_POST["customer_id"];

        // Query to retrieve car details
        $sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, Purchases.PurchaseID 
        FROM Cars 
        JOIN Purchases ON Cars.CarID = Purchases.CarID 
        WHERE Purchases.CustomerID = $customer_id";
        $result = mysqli_query($conn, $sql);

        echo "<h3>Select the car to sell.</h3>";

        // Check if there are any available cars
        if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Generate a radio button for each car
            echo "<input type='radio' id='purchase_id' name='purchase_id' required value='".$row["PurchaseID"]."'>".$row["Make"]." ".$row["Model"]." ".$row["Year"]."<br>";
        }
        } else {
        echo "No available cars.";
        }

        // Close database connection
        $conn->close();
      ?>
      <br>
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <input type="submit" value="Sell the car">
    </form>
    <br>
    <form action='customer_dashboard.php' method='post'>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <input type='submit' value='Return to dashboard'>
    </form>
  	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_car_sell1.txt">Contents of the PHP page</a>
		</div>
	</footer>
  </body>
</html>

