<?php include 'header.php'; ?>
<?php
// Replace with your database credentials
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Retrieve the car ID and customer ID from the previous page
$car_id = $_POST['car_id'];
$customer_id = $_POST['customer_id'];

// Get the car price from the Cars table
$sql = "SELECT Price, Make, Model, Year FROM Cars WHERE CarID = $car_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $purchasePrice = $row["Price"];
  $carName = $row["Make"] . " " . $row["Model"] . " " . $row["Year"];
} else {
  echo "Car not found";
  exit;
}

// Assign an employee randomly
$sql = "SELECT EmployeeID FROM Employees ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $employee_id = $row["EmployeeID"];
    }
} else {
    echo "No employees found";
    exit;
}

// Insert the purchase record into the Purchases table
$purchaseDate = date("Y-m-d");
$sql = "INSERT INTO Purchases (PurchaseDate, PurchasePrice, CarID, CustomerID, EmployeeID)
VALUES ('$purchaseDate', '$purchasePrice', '$car_id', '$customer_id', '$employee_id')";

if ($conn->query($sql)) {
    echo "The $carName has been successfully purchased!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "<br>";
echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_purchase.txt'>Contents of the PHP page</a>";

$conn->close();

?>
