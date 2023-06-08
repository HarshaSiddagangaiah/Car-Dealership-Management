<?php include 'header.php'; ?>
<html>
  <head>
    <title>Customer Dashboard</title>
  </head>
  <body>
<?php
        // Database connection details
        include('connectionData.txt');

        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        $customer_id = $_POST["customer_id"];

        // Query to retrieve customer details
        $sql = "SELECT FirstName FROM Customers Where CustomerID=$customer_id";

        // Execute query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<h2>Welcome to your Dashboard, ' . $row["FirstName"] .'!</h2>';
            
          }
        } else {
          echo "No customers found";
        }

        // Close database connection
        $conn->close();
      ?>
    
    <form action="customer_profile.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type="submit">Customer Profile</button>
    </form>
    <br>
    <form action="customer_owned_cars.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">    
      <button type="submit">Owned Cars List</button>
    </form>
    <br>
    <form action="customer_car_buying.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type="submit">Buy a Car</button>
    </form>
    <br>
    <form action="customer_car_maintenance.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type="submit">Car Maintenance</button>
    </form>
    <br>
    <form action="customer_car_sell.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type="submit">Sell a Car</button>
    </form>
    <br><br>
    <form action='customer_login.php' method='post'>
        <button type="submit" class="return-button">Return</button>
    </form>
  	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_dashboard.txt">Contents of the PHP page</a>
		</div>
	</footer>
    
  </body>
</html>
