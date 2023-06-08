<?php include 'header.php'; ?>
<?php
$car_id = $_POST['car_id'];
$customer_id = $_POST['customer_id'];

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get the car ID and customer ID from the previous page


$select_activity_sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, TestDrives.TestDriveDate, TestDrives.TestDriveTime, TestDrives.CustomerID
                        FROM TestDrives
                        INNER JOIN Appointments ON TestDrives.AppointmentID = Appointments.AppointmentID
                        INNER JOIN Cars ON TestDrives.CarID = Cars.CarID
                        WHERE TestDrives.CarID = $car_id";

$result = $conn->query($select_activity_sql);
$row = $result->fetch_assoc();
$make = $row['Make'];
$model = $row['Model'];
$year = $row['Year'];
$testdrivedate = $row['TestDriveDate'];
$testdrivetime = $row['TestDriveTime'];

// Delete the row from the Maintenances table for the given car ID
$delete_testdrive_sql = "DELETE FROM TestDrives WHERE CarID = $car_id";
$conn->query($delete_testdrive_sql);

// Display a success message
echo "<h2>TestDrive cancelled</h2>";
echo "TestDrive for the car $model $make $year booked for $testdrivedate $testdrivetime has been deleted.";

echo "<br>";
echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_delete_testdrive.txt'>Contents of the PHP page</a>";

$conn->close();

?>
