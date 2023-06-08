<?php include 'header.php'; ?>
<?php

// Connect to the database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Retrieve the customerID from the previous page
$customer_id = $_POST["customer_id"];


// Query the database to get the list of cars purchased by the customer
$sql = "SELECT Cars.Make, Cars.Model, Cars.Year, Cars.Color, Cars.Mileage, Cars.Transmission, 
                Cars.FuelType, Cars.BodyType, Purchases.PurchasePrice, Purchases.PurchaseDate, 
                Employees.FirstName, Employees.LastName
        FROM Cars
        JOIN Purchases ON Cars.CarID = Purchases.CarID
        JOIN Employees ON Purchases.EmployeeID = Employees.EmployeeID
        WHERE Purchases.CustomerID = $customer_id
        ORDER BY Purchases.PurchaseDate DESC";
$result = $conn->query($sql);
echo "<h2>List of all the cars owned</h2>";
// Display the list of cars in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Mileage</th>
                <th>Transmission</th>
                <th>Fuel Type</th>
                <th>Body Type</th>
                <th>Purchase Price</th>
                <th>Purchase Date</th>
                <th>Sold By</th>
            </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["Make"]."</td>
                <td>".$row["Model"]."</td>
                <td>".$row["Year"]."</td>
                <td>".$row["Color"]."</td>
                <td>".$row["Mileage"]."</td>
                <td>".$row["Transmission"]."</td>
                <td>".$row["FuelType"]."</td>
                <td>".$row["BodyType"]."</td>
                <td>".$row["PurchasePrice"]."</td>
                <td>".$row["PurchaseDate"]."</td>
                <td>".$row["FirstName"]." ".$row["LastName"]."</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "This customer has not purchased any cars.";
}

echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_owned_cars.txt'>Contents of the PHP page</a>";

$conn->close();
?>
