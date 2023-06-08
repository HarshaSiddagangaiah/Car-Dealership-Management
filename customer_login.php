<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Customer Login</title>
  </head>
  <body>
    <h2>Customer Login</h2>
    <form action="customer_dashboard.php" method="post">
      <?php
        // Database connection details
        include('connectionData.txt');

        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        // Query to retrieve customer details
        $sql = "SELECT CustomerID, FirstName, LastName, Email FROM Customers";

        // Execute query
        $result = $conn->query($sql);

        // Display customer details as radio buttons
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<input type="radio" id="customer_id" name="customer_id" required value="' . $row["CustomerID"] . '">' . $row["FirstName"] . ' ' . $row["LastName"] . ' (' . $row["Email"] . ')<br>';
            
          }
        } else {
          echo "No customers found";
        }

        // Close database connection
        $conn->close();
      ?>
      <br>
      <button type="submit">Login</button>
    </form>
    <br>
    <form action='index.php' method='post'>
        <button type="submit" class="return-button">Return</button>
    </form>
  	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_login.txt">Contents of the PHP page</a>
		</div>
	</footer>
  </body>
</html>

