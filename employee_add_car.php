<?php include 'header.php'; ?>
<?php
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
// Retrieve customer information from previous page
$employee_id = $_POST["employee_id"];

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Car</title>
</head>
<body>
	<h2>Car Addition</h2>
	<form action="employee_car_addition.php" method="post">
    <table>
	<input type='hidden' name='employee_id' value="<?php echo $employee_id; ?>">
    <tr><td><label for="make">Make:</label></td><td>
		<input type="text" name="make" required></td></tr>
	<tr><td><label for="model">Model:</label></td><td>
		<input type="text" name="model" required></td></tr>
	<tr><td><label for="year">Year:</label></td><td>
		<input type="number" name="year" required></td></tr>
	<tr><td><label for="price">Price:</label></td><td>
		<input type="number" name="price" step="0.01" required></td></tr>
	<tr><td><label for="color">Color:</label></td><td>
		<input type="text" name="color" required></td></tr>
	<tr><td><label for="mileage">Mileage:</label></td><td>
		<input type="number" name="mileage" required></td></tr>
	<tr><td><label for="transmission">Transmission:</label></td><td>
		<input type="text" name="transmission" required></td></tr>
	<tr><td><label for="fuelType">Fuel Type:</label></td><td>
		<input type="text" name="fuelType" required></td></tr>
	<tr><td><label for="bodyType">Body Type:</label></td><td>
		<input type="text" name="bodyType" required></td></tr>
    <tr><td><button type='submit'>Add Car</button></td></tr>
    </table>
	</form>
	<br>
	<form action="employee_manage_car.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_add_car.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
