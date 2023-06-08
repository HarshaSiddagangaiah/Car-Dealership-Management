<?php include 'header.php'; ?>
<?php
// Get the customer_id, car_id, and appointment_id from the previous page
$customer_id = $_POST['customer_id'];
$car_id = $_POST['car_id'];
$appointment_id = $_POST['appointment_id'];

// Get the appointment date and time from the Appointments table
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

$sql = "SELECT AppointmentDate, AppointmentTime FROM Appointments WHERE AppointmentID = $appointment_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointment_date = $row['AppointmentDate'];
        $appointment_time = $row['AppointmentTime'];
    }
} else {
    echo "Error: Appointment not found.";
    exit();
}

// Insert the maintenance record into the Maintenances table
$sql = "INSERT INTO Maintenances (CustomerID, CarID, AppointmentID, MaintenanceDate, MaintenanceTime)
        VALUES ('$customer_id', '$car_id', '$appointment_id', '$appointment_date', '$appointment_time')";
if ($conn->query($sql)) {
    $maintenance_id = $conn->insert_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Insert each maintenance type ID as a row into the MaintenanceActivity table
$maintenance_types = $_POST['maintenance_types'];
foreach ($maintenance_types as $maintenance_type_id) {
    $sql = "INSERT INTO MaintenanceActivity (MaintenanceID, MaintenanceTypeID)
            VALUES ('$maintenance_id', '$maintenance_type_id')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }
}

$customer_query = "SELECT * FROM Customers WHERE CustomerID=$customer_id";
$customer_result = $conn->query($customer_query);
$customer_row = $customer_result->fetch_assoc();

$car_query = "SELECT * FROM Cars WHERE CarID=$car_id";
$car_result = $conn->query($car_query);
$car_row = $car_result->fetch_assoc();

$appointment_query = "SELECT * FROM Appointments WHERE AppointmentID=$appointment_id";
$appointment_result = $conn->query($appointment_query);
$appointment_row = $appointment_result->fetch_assoc();

$maintenance_query = "SELECT SUM(MaintenanceCost) AS TotalMaintenanceCost
                    FROM MaintenanceActivity ma
                    JOIN MaintenanceTypes mt ON ma.MaintenanceTypeID = mt.MaintenanceTypeID
                    WHERE ma.MaintenanceID = $maintenance_id";
$maintenance_result = $conn->query($maintenance_query);
$maintenance_row = $maintenance_result->fetch_assoc();

echo "<h2> Maintenance Booked!</h2>";
echo "Maintenance has been successfully scheduled for the following car:<br>";
echo "Make: " . $car_row['Make'] . "<br>";
echo "Model: " . $car_row['Model'] . "<br>";
echo "Year: " . $car_row['Year'] . "<br>";
echo "Color: " . $car_row['Color'] . "<br>";
echo "Mileage: " . $car_row['Mileage'] . "<br>";
echo "<br>";
echo "Customer Details:<br>";
echo "Name: " . $customer_row['FirstName'] . " " . $customer_row['LastName'] . "<br>";
echo "Email: " . $customer_row['Email'] . "<br>";
echo "Phone: " . $customer_row['Phone'] . "<br>";
echo "<br>";
echo "Appointment Details:<br>";
echo "Appointment Date: " . $appointment_row['AppointmentDate'] . "<br>";
echo "Appointment Time: " . $appointment_row['AppointmentTime'] . "<br>";
echo "Total Maintenance Cost: " . $maintenance_row['TotalMaintenanceCost'] . "<br>";
echo "<br>";

echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_maintenance_success.txt'>Contents of the PHP page</a>";


// Close the database connection
$conn->close();
?>