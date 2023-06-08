<?php include 'header.php'; ?>
<?php
// Connect to the database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Retrieve the customer ID from the previous page
$customer_id = $_POST['customer_id'];

$maintenance_cars_sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, Appointments.AppointmentID, Appointments.AppointmentDate, Appointments.AppointmentTime, Maintenances.CustomerID
                         FROM Maintenances 
                         JOIN Cars ON Maintenances.CarID = Cars.CarID
                         JOIN Appointments ON Maintenances.AppointmentID = Appointments.AppointmentID
                         WHERE Maintenances.CustomerID = $customer_id";
$maintenance_cars_result = $conn->query($maintenance_cars_sql);


// Display the cars in maintenance
echo "<h2>Cars Booked for Maintenance</h2>";
if ($maintenance_cars_result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Make</th><th>Model</th><th>Year</th><th>Appointment Date</th><th>Appointment Time</th><th>Delete</th></tr>";
    while ($row = $maintenance_cars_result->fetch_assoc()) {
        echo "<tr><td>" . $row['Make'] . "</td><td>" . $row['Model'] . "</td><td>" . $row['Year'] . "</td><td>" . $row['AppointmentDate'] . "</td><td>" . $row['AppointmentTime'] . "</td>";
        echo "<td><form method='post' action='customer_car_delete_maintenance.php'><input type='hidden' name='car_id' value='" . $row['CarID'] . "'><input type='hidden' name='customer_id' value='" . $row['CustomerID'] . "'><button type='submit'>Delete</button></form></td></tr>";
    }
    echo "</table>";
} else {
    echo "No cars in maintenance.<br>";
}
echo "<br>";

echo "<h2>Select Cars for Maintenance</h2>";
// Get the customer's cars
$cars_sql = "SELECT * FROM Cars WHERE CarID IN (SELECT CarID FROM Purchases WHERE CustomerID = $customer_id)";
$cars_result = $conn->query($cars_sql);

// Get the available maintenance types
$maintenance_types_sql = "SELECT * FROM MaintenanceTypes";
$maintenance_types_result = $conn->query($maintenance_types_sql);

// Get the available appointments for maintenance
$appointments_sql = "SELECT * FROM Appointments WHERE AppointmentType = 'Maintenance'
                    AND Appointments.AppointmentID NOT IN (SELECT AppointmentID FROM Maintenances)";
$appointments_result = $conn->query($appointments_sql);

// Display the form
echo "<form action='customer_car_maintenance_success.php' method='post'>";

// Display the customer ID as a hidden field
echo "<input type='hidden' name='customer_id' value='$customer_id'>";

// Display the cars as a dropdown
echo "Cars: <select name='car_id' required>";
echo "<option value='' selected disabled>Select Car</option>";
while ($row = $cars_result->fetch_assoc()) {
    $car_id = $row['CarID'];

    //check if the car has any maintenance bookings
    $sql2 = "SELECT * FROM Maintenances WHERE CarID = $car_id";
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result2) == 0) {
      //no maintenance bookings for this car, add to dropdown list
      echo "<option value='" . $row['CarID'] . "'>" . $row['Make'] . " " . $row['Model'] . " " . $row['Year'] . "</option>";
    } else {
      //maintenance booking found for this car, skip
      echo "<option disabled>" . $row['Make'] . " " . $row['Model'] . " " . $row['Year'] . " (Maintenance booked)</option>";
    }

}
echo "</select><br><br>";

// Display the maintenance types as a checklist
echo "Maintenance Types:<br>";
while ($row = $maintenance_types_result->fetch_assoc()) {
    echo "<input type='checkbox' id='name' name='maintenance_types[]' value='" . $row['MaintenanceTypeID'] . " '>" . $row['MaintenanceType'] . " - $" . $row['MaintenanceCost'] . "<br>";
}
echo "<br>";

// Display the appointments as a dropdown
echo "Appointments: <select name='appointment_id' required>";
echo "<option value='' selected disabled>Select Appointment</option>";
while ($row = $appointments_result->fetch_assoc()) {
    echo "<option value='" . $row['AppointmentID'] . "'>" . $row['AppointmentDate'] . " " . $row['AppointmentTime'] . "</option>";
}
echo "</select><br><br>";

// Display the submit button
echo "<button type='submit'>Book Maintenance</button>";
if (isset($_POST['submit'])) {
    $maintenance_types = $_POST['maintenance_types'];
    if (count($maintenance_types) < 1) {
        echo "<p style='color:red;'>Please select at least one maintenance type.</p>";
    }
}

echo "</form>";

echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";

echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_maintenance.txt'>Contents of the PHP page</a>";

// Close the database connection
$conn->close();
?>
