<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Profile</title>
</head>
<body>
	<?php
        // Connect to the database
        include('connectionData.txt');
        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        // Get the customer ID from the previous page
        $customer_id = $_POST["customer_id"];
        $customer_email = $_POST["customer_email"];
        $customer_phone = $_POST["customer_phone"];
        $customer_address = $_POST["customer_address"];

        $sql = "UPDATE Customers SET Email='$customer_email', Phone='$customer_phone', Address='$customer_address' WHERE CustomerID='$customer_id'";

        // Execute SQL statement
        if ($conn->query($sql)) {
            echo "Customer table updated successfully";
            
            } else {
            echo "Error updating customer table: " . $conn->error;
        }

        // Close database connection
        $conn->close();
?>
    <br><br>
	<!-- Button to go back to home page -->
	<form action="customer_profile.php" method="post">
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <button type='submit' class='return-button'>Return back to Customer Profile</button>
	</div>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_profile_update.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>