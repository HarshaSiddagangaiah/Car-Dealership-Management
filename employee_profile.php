<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
</head>
<body>
    <h2>Employee Details</h2>
    
<?php
// Connect to the database
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get the customer ID from the previous page
$employee_id = $_POST["employee_id"];

// Query the database to get the customer details
$sql = "SELECT EmployeeID, FirstName, LastName, Email, Phone, Address, HireDate FROM Employees WHERE EmployeeID = $employee_id";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Display the customer details in a table
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Employee ID:</td><td>" . $row["EmployeeID"] . "</td></tr>";
        echo "<tr><td>FirstName:</td><td>" . $row["FirstName"] . "</td></tr>";
        echo "<tr><td>LastName:</td><td>" . $row["LastName"] . "</td></tr>";
        echo "<tr><td>Email:</td><td>" . $row["Email"] . "</td></tr>";
        echo "<tr><td>Phone:</td><td>" . $row["Phone"] . "</td></tr>";
        echo "<tr><td>Address:</td><td>" . $row["Address"] . "</td></tr>";
        echo "<tr><td>HireDate:</td><td>" . $row["HireDate"] . "</td></tr>";

    }
    echo "</table>";
    echo "<form action='employee_edit.php' method='post'>";
        echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
        echo "<button type='submit'>Edit</button>";
        echo "</form>";
        echo "<br>";
    echo "<form action='employee_dashboard.php' method='post'>";
        echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
        echo "<button type='submit' class='return-button'>Return</button>";
        echo "</form>";
} else {
    // Display an error message if no rows were returned
    echo "No employee found with ID $employee_id";
}

// Close the database connection
mysqli_close($conn);
?>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_profile.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>


