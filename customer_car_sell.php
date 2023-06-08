<?php include 'header.php'; ?>
<?php
//connect to database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

// Get the customer ID from the previous page
$customer_id = $_POST["customer_id"];


//get purchased cars for the customer
$sql = "SELECT Cars.CarID, Cars.Make, Cars.Model, Cars.Year, Purchases.PurchaseID 
        FROM Cars 
        JOIN Purchases ON Cars.CarID = Purchases.CarID 
        WHERE Purchases.CustomerID = $customer_id";
$result = mysqli_query($conn, $sql);

echo "<h2>Car Selling.</h2>";
echo "<h3>Select the car to sell.</h3>";

//check if there are any purchased cars for the customer
if(mysqli_num_rows($result) == 0) {
  echo "No purchased cars found for this customer.";
} else {
  //start dropdown list
  echo "<form action='customer_car_sold.php' method='post'>";
  echo "<select name='purchase_id' required>";
  echo "<option value='' selected disabled>Select Car</option>";

  //loop through each purchased car and add to dropdown list
  while($row = mysqli_fetch_assoc($result)) {
    $car_id = $row['CarID'];
    $make = $row['Make'];
    $model = $row['Model'];
    $year = $row['Year'];
    $purchase_id = $row['PurchaseID'];
    
    //check if the car has any maintenance bookings
    $sql2 = "SELECT * FROM Maintenances WHERE CarID = $car_id";
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result2) == 0) {
      //no maintenance bookings for this car, add to dropdown list
      echo "<option value='$purchase_id'>$year $make $model</option>";
    } else {
      //maintenance booking found for this car, skip
      echo "<option disabled>$year $make $model (Maintenance booked)</option>";
    }
  }

  //end dropdown list and add submit button
  echo "</select>";
  echo "<input type='hidden' name='customer_id' value='$customer_id'>";
  echo "<button type='submit'>Sell Car</button>";
  
  echo "</form>";
}

echo "<form action='customer_dashboard.php' method='post'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<button type='submit' class='return-button'>Return to Dashboard</button>";
echo "</form>";

echo "<br><br>";
echo "<a href='customer_car_sell.txt'>Contents of the PHP page</a>";

//close database connection
mysqli_close($conn);
?>
