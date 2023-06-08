<?php include 'header.php'; ?>
<?php
// Establish database connection
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get form data
$customer_id = $_POST['customer_id'];
$car_id = $_POST['car_id'];
$appointmentid = $_POST['appointmentid'];

// Get TestDriveDate and TestDriveTime from Appointments table using appointmentid
$sql = "SELECT AppointmentDate, AppointmentTime FROM Appointments WHERE AppointmentID = $appointmentid";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $testdrivedate = $row["AppointmentDate"];
    $testdrivetime = $row["AppointmentTime"];
} else {
    echo "Error: Appointment details not found";
}

// Insert data into TestDrives table
$sql = "INSERT INTO TestDrives (CustomerID, CarID, AppointmentID, TestDriveDate, TestDriveTime) 
        VALUES ($customer_id, $car_id, $appointmentid, '$testdrivedate', '$testdrivetime')";

if (mysqli_query($conn, $sql)) {
    // Display success message
    $sql = "SELECT * FROM Customers WHERE CustomerID = $customer_id";
    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM Cars WHERE CarID = $car_id";
    $result = mysqli_query($conn, $sql);
    $car = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM Appointments JOIN Employees ON Appointments.EmployeeID = Employees.EmployeeID 
            WHERE AppointmentID = $appointmentid";
    $result = mysqli_query($conn, $sql);
    $appointment = mysqli_fetch_assoc($result);
    
    echo "<h3>Test drive has been booked successfully</h3>";

    echo "<ul>";
    echo "<li> Customer Name : " . $customer['FirstName'] . " " . $customer['LastName'] . "</li>";
    echo "<li> Employee Name : " . $appointment['FirstName'] . " " . $appointment['LastName'] . "</li>";
    echo "<li> Car Name : " . $car['Year'] . " " . $car['Make'] . " " . $car['Model'] . "</li>";
    echo "<li> Appointment Date: ". $appointment['AppointmentDate'] . " at " . $appointment['AppointmentTime'] . "</li>";
    echo "</ul>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_testdrive_submit.txt'>Contents of the PHP page</a>";
// Close database connection
mysqli_close($conn);
?>
