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
	<title>Appointment List</title>
</head>
<body>
	<h2>Appointment List</h2>
	<table border="1">
		<tr>
			<th>Employee ID</th>
			<th>Appointment Date</th>
			<th>Appointment Time</th>
			<th>Appointment Type</th>
			<th>Status</th>
		</tr>
		<?php
			// Connect to database
            include('connectionData.txt');

            $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
            or die('Error connecting to MySQL server.');

			// Query appointments table and join with test drives and maintenances tables
			$sql = "SELECT Appointments.*, 
					CASE 
						WHEN TestDrives.TestDriveID IS NOT NULL THEN 'Booked'
						WHEN Maintenances.MaintenanceID IS NOT NULL THEN 'Booked'
						ELSE 'Not Booked'
					END AS status
					FROM Appointments 
					LEFT JOIN TestDrives ON Appointments.AppointmentID = TestDrives.AppointmentID
					LEFT JOIN Maintenances ON Appointments.AppointmentID = Maintenances.AppointmentID
					WHERE Appointments.EmployeeID = $employee_id";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>".$row["EmployeeID"]."</td>";
			        echo "<td>".$row["AppointmentDate"]."</td>";
			        echo "<td>".$row["AppointmentTime"]."</td>";
			        echo "<td>".$row["AppointmentType"]."</td>";
			        echo "<td>".$row["status"]."</td>";
			        echo "</tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
		?>
	</table>
    <br>
	<form action="employee_manage_appointments.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	  <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_list_appointments.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
