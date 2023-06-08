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
	<title>Manage Cars</title>
	<style>
		form {
			display: inline-block;
		}
	</style>
</head>
<body>
	<h2>Manage Cars</h2>
	<br>
	<form action="employee_list_car.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type="submit">List Cars</button>
	</form>
	<form action="employee_add_car.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type="submit">Add Cars</button>
	</form>

	<br> <br>
	<form action="employee_dashboard.php" method="post">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<button type='submit' class='return-button'>Return</button>
	</form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_manage_car.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
