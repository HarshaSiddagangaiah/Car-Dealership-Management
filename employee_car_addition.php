<?php include 'header.php'; ?>
<?php
// Connect to database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

$employee_id = $_POST["employee_id"];

// Get form data
$make = $_POST["make"];
$model = $_POST["model"];
$year = $_POST["year"];
$price = $_POST["price"];
$color = $_POST["color"];
$mileage = $_POST["mileage"];
$transmission = $_POST["transmission"];
$fuelType = $_POST["fuelType"];
$bodyType = $_POST["bodyType"];

// Insert data into table
$sql = "INSERT INTO Cars (Make, Model, Year, Price, Color, Mileage, Transmission, FuelType, BodyType)
VALUES ('$make', '$model', '$year', '$price', '$color', '$mileage', '$transmission', '$fuelType', '$bodyType')";

if ($conn->query($sql)) {
    echo "Car added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "<br><br>";
echo "<form action='employee_list_car.php' method='post'>";
echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
echo "<button type='submit'>Check Car List</button>";
echo "</form>";

echo "<br><br>";
echo "<form action='employee_manage_car.php' method='post'>";
echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
echo "<button type='submit' class='return-button'>Return to Manage Cars</button>";
echo "</form>"; 

echo "<br><br>";
echo "<a href='employee_car_addition.txt'>Contents of the PHP page</a>";

$conn->close();
?>
