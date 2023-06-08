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
	<title>Car List</title>
</head>
<body>
	<h2>Car List</h2>
	<table border="1">
		<tr>
			<th>Car ID</th>
			<th>Make</th>
			<th>Model</th>
			<th>Year</th>
			<th>Price</th>
			<th>Color</th>
			<th>Mileage</th>
			<th>Transmission</th>
			<th>Fuel Type</th>
			<th>Body Type</th>
		</tr>
		<?php
			// Connect to database
            include('connectionData.txt');

            $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
            or die('Error connecting to MySQL server.');

			// Query cars table
			$sql = "SELECT * FROM Cars";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>".$row["CarID"]."</td>";
			        echo "<td>".$row["Make"]."</td>";
			        echo "<td>".$row["Model"]."</td>";
			        echo "<td>".$row["Year"]."</td>";
			        echo "<td>".$row["Price"]."</td>";
			        echo "<td>".$row["Color"]."</td>";
			        echo "<td>".$row["Mileage"]."</td>";
			        echo "<td>".$row["Transmission"]."</td>";
			        echo "<td>".$row["FuelType"]."</td>";
			        echo "<td>".$row["BodyType"]."</td>";
			        echo "</tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
		?>
	</table>
    <br>
	<form action="employee_manage_car.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	  <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_list_car.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
