<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
</head>
<body>
    <h2>Customer Details</h2>
    
<?php
// Connect to the database
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get the customer ID from the previous page
$customer_id = $_POST["customer_id"];

// Query the database to get the customer details
$sql = "SELECT CustomerID, FirstName, LastName, Email, Phone, Address FROM Customers WHERE CustomerID = $customer_id";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Display the customer details in a table
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Customer ID:</td><td>" . $row["CustomerID"] . "</td></tr>";
        echo "<tr><td>FirstName:</td><td>" . $row["FirstName"] . "</td></tr>";
        echo "<tr><td>LastName:</td><td>" . $row["LastName"] . "</td></tr>";
        echo "<tr><td>Email:</td><td>" . $row["Email"] . "</td></tr>";
        echo "<tr><td>Phone:</td><td>" . $row["Phone"] . "</td></tr>";
        echo "<tr><td>Address:</td><td>" . $row["Address"] . "</td></tr>";
    }
    echo "</table>";
    echo "<form action='customer_edit.php' method='post'>";
        echo "<input type='hidden' name='customer_id' value='" . $customer_id . "'>";
        echo "<button type='submit' class='edit-button'>Edit</button>";
        echo "</form>";
        echo "<br>";
    echo "<form action='customer_dashboard.php' method='post'>";
        echo "<input type='hidden' name='customer_id' value='" . $customer_id . "'>";
        echo "<button type='submit' class='return-button'>Return</button>";
        echo "</form>";
} else {
    // Display an error message if no rows were returned
    echo "No customer found with ID $customer_id";
}

// Close the database connection
mysqli_close($conn);
?>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_profile.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>


