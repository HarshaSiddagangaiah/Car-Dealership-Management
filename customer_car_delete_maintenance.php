<?php include 'header.php'; ?>
<?php
$car_id = $_POST['car_id'];
$customer_id = $_POST['customer_id'];

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get the car ID and customer ID from the previous page


$select_activity_sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, Appointments.AppointmentID, Appointments.AppointmentDate, Appointments.AppointmentTime
                        FROM Maintenances 
                        JOIN Cars ON Maintenances.CarID = Cars.CarID
                        JOIN Appointments ON Maintenances.AppointmentID = Appointments.AppointmentID
                        WHERE Maintenances.CarID = $car_id";

$result = $conn->query($select_activity_sql);
$row = $result->fetch_assoc();
$make = $row['Make'];
$model = $row['Model'];
$year = $row['Year'];
$appointmentdate = $row['AppointmentDate'];
$appointmenttime = $row['AppointmentTime'];

// Delete the rows from the MaintenanceActivity table for the given MaintenanceID
$delete_activity_sql = "DELETE FROM MaintenanceActivity WHERE MaintenanceID IN (SELECT MaintenanceID FROM Maintenances WHERE CarID = $car_id)";
$conn->query($delete_activity_sql);

// Delete the row from the Maintenances table for the given car ID
$delete_maintenance_sql = "DELETE FROM Maintenances WHERE CarID = $car_id";
$conn->query($delete_maintenance_sql);

// Display a success message
echo "<h2>Maintenance cancelled</h2>";
echo "Maintenance for the car $model $make $year booked for $appointmentdate $appointmenttime has been deleted.";

echo "<br>";
echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_delete_maintenance.txt'>Contents of the PHP page</a>";

$conn->close();

?>
