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
	<title>Maintenance Packages List</title>
</head>
<body>
	<h2>Maintenance Packages List</h2>
	<table border="1">
		<tr>
			<th>MaintenanceType ID</th>
			<th>Maintenance Type</th>
			<th>Maintenance Cost</th>
		</tr>
		<?php
			// Connect to database
            include('connectionData.txt');

            $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
            or die('Error connecting to MySQL server.');

			// Query cars table
			$sql = "SELECT * FROM MaintenanceTypes";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>".$row["MaintenanceTypeID"]."</td>";
			        echo "<td>".$row["MaintenanceType"]."</td>";
			        echo "<td>".$row["MaintenanceCost"]."</td>";
			        echo "</tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
		?>
	</table>
    <br>
	<form action="employee_manage_maintenancetypes.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	  <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_list_maintenancepackages.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
