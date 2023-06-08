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
	<title>Add Maintenance Packages</title>
</head>
<body>
	<h2>Maintenance Packages Addition</h2>
	<form action="employee_add_maintenancepackages_success.php" method="post">
    <table>
	<input type='hidden' name='employee_id' value="<?php echo $employee_id; ?>">
    <tr><td><label for="maintenancetype">Maintenance Type:</label></td><td>
		<input type="text" name="maintenancetype" required></td></tr>
	<tr><td><label for="maintenancecost">Maintenance Cost:</label></td><td>
		<input type="text" name="maintenancecost" required></td></tr>
    <tr><td><button type='submit'>Add Maintenance Package</button></td></tr>
    </table>
	</form>
	<br>
	<form action="employee_manage_maintenancetypes.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	  <button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_add_maintenancepackages.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
