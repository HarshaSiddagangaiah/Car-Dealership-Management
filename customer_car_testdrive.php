<?php include 'header.php'; ?>
<?php
// connect to the database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// get carid and customerid from previous page
$car_id = $_POST['car_id'];
$customer_id = $_POST['customer_id'];

// get all test drives for this customer and car
$sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, TestDrives.TestDriveDate, TestDrives.TestDriveTime, TestDrives.CustomerID
        FROM TestDrives
        INNER JOIN Appointments ON TestDrives.AppointmentID = Appointments.AppointmentID
        INNER JOIN Cars ON TestDrives.CarID = Cars.CarID
        WHERE TestDrives.CustomerID = $customer_id";
$result = mysqli_query($conn, $sql);
$test_drives = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<h2>Test Drive Appointment</h2>";
if (count($test_drives) > 0) {
	echo "<h2>List of Booked Test Drives:</strong></h2>";
    echo "<table border='1'>";
    echo "<tr><th>Make</th><th>Model</th><th>Year</th><th>TestDrive Date</th><th>TestDrive Time</th><th>Delete</th></tr>";
    foreach ($test_drives as $test_drive) {
        echo "<tr><td>" . $test_drive['Make'] . "</td><td>" . $test_drive['Model'] . "</td><td>" . $test_drive['Year'] . "</td><td>" . $test_drive['TestDriveDate'] . "</td><td>" . $test_drive['TestDriveTime'] . "</td>";
        echo "<td><form method='post' action='customer_car_delete_testdrive.php'><input type='hidden' name='car_id' value='" . $test_drive['CarID'] . "'><input type='hidden' name='customer_id' value='" . $test_drive['CustomerID'] . "'><button type='submit'>Delete</button></form></td></tr>";
    }
    echo "</table>";
} else {
	echo "<h2>List of Booked Test Drives:</strong></h2>";
    echo "No cars have been booked for Test Drive yet!!<br>";
}
echo "<br>";



// get car details
$sql = "SELECT * FROM Cars WHERE CarID = $car_id";
$result = mysqli_query($conn, $sql);
$car = mysqli_fetch_assoc($result);

// get appointments available for test drive
$sql = "SELECT Appointments.AppointmentID, Appointments.AppointmentDate, Appointments.AppointmentTime, Employees.FirstName, Employees.LastName 
        FROM Appointments 
        INNER JOIN Employees ON Appointments.EmployeeID = Employees.EmployeeID 
        WHERE Appointments.AppointmentType = 'Test Drive' 
        AND Appointments.AppointmentID NOT IN (SELECT AppointmentID FROM TestDrives)";

$result = mysqli_query($conn, $sql);
$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Test Drive</title>
</head>
<body>
	<h2> Book Test Drive </h2>
	<p><strong>Car Details:</strong></p>
	<ul>
		<li><strong>Make:</strong> <?php echo $car['Make']; ?></li>
		<li><strong>Model:</strong> <?php echo $car['Model']; ?></li>
		<li><strong>Year:</strong> <?php echo $car['Year']; ?></li>
		<li><strong>Price:</strong> <?php echo $car['Price']; ?></li>
		<li><strong>Color:</strong> <?php echo $car['Color']; ?></li>
		<li><strong>Mileage:</strong> <?php echo $car['Mileage']; ?></li>
		<li><strong>Transmission:</strong> <?php echo $car['Transmission']; ?></li>
		<li><strong>Fuel Type:</strong> <?php echo $car['FuelType']; ?></li>
		<li><strong>Body Type:</strong> <?php echo $car['BodyType']; ?></li>
	</ul>

	<form action="customer_car_testdrive_submit.php" method="post">
		<p><strong>Select an Appointment:</strong></p>
        
		<select name="appointmentid" required>
        <option value='' selected disabled>Select Appointment</option>
			<?php foreach ($appointments as $appointment): ?>
				<option value="<?php echo $appointment['AppointmentID']; ?>">
					<?php echo $appointment['AppointmentDate'] . " " . $appointment['AppointmentTime'] . " with " . $appointment['FirstName'] . " " . $appointment['LastName']; ?>
				</option>
			<?php endforeach; ?>
		</select>
		<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
		<input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
		<button type='submit'>Schedule Test Drive</button>
	</form>
    <br>
    <form action='customer_car_price_quote.php' method='post'>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
		<button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_car_testdrive.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>

