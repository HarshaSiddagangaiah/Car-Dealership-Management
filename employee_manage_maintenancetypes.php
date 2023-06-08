<?php include 'header.php'; ?>
<?php
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
// Retrieve customer information from previous page
$employee_id = $_POST["employee_id"];

$conn->close();

?>

<html>
<head>
	<title>Manage Maintenance Packages</title>
	<style>
		form {
			display: inline-block;
		}
	</style>
</head>
<body>
	<h2>Manage Maintenance Packages</h2>
	<br>
	<form action="employee_list_maintenancepackages.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type="submit">List Maintenance Packages</button>
	</form>
	<form action="employee_add_maintenancepackages.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type="submit">Add Maintenance Packages</button>
	</form>

	<br> <br>
	<form action="employee_dashboard.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type='submit' class='return-button'>Return</button>
	</form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_manage_maintenancetypes.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
