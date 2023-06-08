<?php include 'header.php'; ?>
<?php
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
// Retrieve customer information from previous page
$employee_id = $_POST["employee_id"];

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer List</title>
</head>
<body>
	<h2>Customer List</h2>
	<table border="1">
		<tr>
			<th>Customer ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
		</tr>
		<?php
			// Connect to database
            include('connectionData.txt');

            $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
            or die('Error connecting to MySQL server.');

			// Query customers table
			$sql = "SELECT * FROM Customers";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // Output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>".$row["CustomerID"]."</td>";
			        echo "<td>".$row["FirstName"]."</td>";
			        echo "<td>".$row["LastName"]."</td>";
			        echo "<td>".$row["Email"]."</td>";
			        echo "<td>".$row["Phone"]."</td>";
			        echo "<td>".$row["Address"]."</td>";
			        echo "</tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
		?>
	</table>
    <br>
	<form action="employee_manage_customer.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	  <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_list_customer.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
