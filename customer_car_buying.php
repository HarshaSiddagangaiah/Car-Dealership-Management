<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Car List</title>
  </head>
  <body>
    <h2>Car List</h2>
    <form action="customer_car_price_quote.php" method="post">
      <?php
        // Database connection details
        include('connectionData.txt');

        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        // Get the customer ID from the previous page
        $customer_id = $_POST["customer_id"];

        // Query to retrieve car details
        $sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, Cars.Price, Cars.Color, Cars.Mileage, Cars.Transmission, Cars.FuelType, Cars.BodyType
        FROM Cars
        LEFT JOIN Purchases ON Cars.CarID = Purchases.CarID
        LEFT JOIN TestDrives ON Cars.CarID = TestDrives.CarID
        WHERE Purchases.CarID IS NULL AND TestDrives.CarID IS NULL";

        // Display customer details as radio buttons
        $result = $conn->query($sql);

        echo "<h3>Select the car to get a Price Quote or for a TestDrive.</h3>";

        // Check if there are any available cars
        if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Generate a radio button for each car
            echo "<input type='radio' id='car_id' name='car_id' required value='".$row["CarID"]."'>".$row["Make"]." ".$row["Model"]." ".$row["Year"]." ".$row["Color"]."<br>";
        }
        } else {
        echo "No available cars.";
        }

        // Close database connection
        $conn->close();
      ?>
      <br>
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type='submit'>Select</button>
    </form>
    <br>
    <form action='customer_dashboard.php' method='post'>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <button type='submit' class='return-button'>Return</button>
    </form>

  <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_car_buying.txt">Contents of the PHP page</a>
		</div>
	</footer>
  </body>
</html>

