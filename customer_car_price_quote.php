<?php include 'header.php'; ?>
<?php

// Connect to the database
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Retrieve the car ID and customer ID from the previous page
$car_id = $_POST['car_id'];
$customer_id = $_POST['customer_id'];

// Retrieve the car details
$sql = "SELECT * FROM Cars WHERE CarID = $car_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Display the car details in a table
echo "<h2>Car Details</h2>";
echo "<table>";
echo "<tr><td>Make:</td><td>{$row['Make']}</td></tr>";
echo "<tr><td>Model:</td><td>{$row['Model']}</td></tr>";
echo "<tr><td>Year:</td><td>{$row['Year']}</td></tr>";
echo "<tr><td>Price:</td><td>{$row['Price']}</td></tr>";
echo "<tr><td>Color:</td><td>{$row['Color']}</td></tr>";
echo "<tr><td>Mileage:</td><td>{$row['Mileage']}</td></tr>";
echo "<tr><td>Transmission:</td><td>{$row['Transmission']}</td></tr>";
echo "<tr><td>Fuel Type:</td><td>{$row['FuelType']}</td></tr>";
echo "<tr><td>Body Type:</td><td>{$row['BodyType']}</td></tr>";
echo "</table>";

echo "<br>";

echo "<form action='customer_car_testdrive.php?' method='post' style='display: inline-block;'>";
echo "<input type='hidden' name='car_id' value='$car_id'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit'>Testdrive</button>";

echo "</form>";

// Display a button to purchase the car
echo "<form action='customer_car_purchase.php' method='post' style='display: inline-block;'>";
echo "<input type='hidden' name='car_id' value='$car_id'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit'>Purchase</button>";

echo "</form>";

echo "<br>";
echo "<br>";
echo "<form action='customer_car_buying.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_price_quote.txt'>Contents of the PHP page</a>";

// Close the database connection
$conn->close();
?>
