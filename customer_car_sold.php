<?php include 'header.php'; ?>
<?php


// Retrieving the purchase details using the purchaseid
$purchase_id = $_POST['purchase_id'];

// Establishing a database connection
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

$sql = "SELECT CarID, CustomerID, PurchasePrice, PurchaseDate, EmployeeID 
        FROM Purchases 
        WHERE PurchaseID = $purchase_id";
$result = $conn->query($sql);

// Checking if the purchaseid exists in the purchases table
if ($result->num_rows == 0) {
  echo "Invalid purchaseid!";
} else {
  // Storing the purchase details in variables
  $row = $result->fetch_assoc();
  $car_id = $row['CarID'];
  $customer_id = $row['CustomerID'];
  $purchase_date = $row['PurchaseDate'];
  $purchase_price = $row['PurchasePrice'];
  $employee_id = $row['EmployeeID'];
  
  // Checking if the car is available for sale
  $sql2 = "SELECT * 
           FROM Cars 
           WHERE CarID = $car_id 
           AND NOT EXISTS (
                            SELECT * 
                            FROM Maintenances 
                            WHERE CarID = $car_id)";
  $result2 = $conn->query($sql2);
  
  // Checking if the car is available for sale
  if ($result2->num_rows == 0) {
    echo "This car is not available for sale!";
  } else {
    // Calculating the sold price
    $sold_price = $purchase_price * 0.9;
    
    // Inserting the sold car details into the soldcars table
    $sql3 = "INSERT INTO SoldCars (PurchaseDate, PurchasePrice, SoldDate, SoldPrice, CarID, CustomerID, EmployeeID)
            VALUES ('$purchase_date', '$purchase_price', NOW(), '$sold_price', $car_id, $customer_id, $employee_id)";
    if ($conn->query($sql3)) {
      // Deleting the purchased car details from the purchases table
      $sql4 = "DELETE FROM Purchases 
               WHERE PurchaseID = $purchase_id";
      if ($conn->query($sql4)) {
        // Retrieving the car details to display the sold car information
        $sql5 = "SELECT Make, Model, Year 
                 FROM Cars 
                 WHERE CarID = $car_id";
        $result5 = $conn->query($sql5);
        $row5 = $result5->fetch_assoc();
        $make = $row5['Make'];
        $model = $row5['Model'];
        $year = $row5['Year'];
        echo "$make $model $year has been sold at $sold_price!";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
    } else {
      echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
  }
}

echo "<br>";
echo "<br>";
echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_sold.txt'>Contents of the PHP page</a>";

// Closing the database connection
$conn->close();



?>
