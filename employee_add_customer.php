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
	<title>Add Customer</title>
</head>
<body>
	<h2>Customer Addition</h2>
	<form action="employee_customer_addition.php" method="post">
    <table>
	<input type='hidden' name='employee_id' value="<?php echo $employee_id; ?>">
    <tr><td><label for="firstName">First Name:</label></td><td>
		<input type="text" name="firstName" required></td></tr>
	<tr><td><label for="lastName">Last Name:</label></td><td>
		<input type="text" name="lastName" required></td></tr>
	<tr><td><label for="email">Email:</label></td><td>
		<input type="email" name="email" required></td></tr>
	<tr><td><label for="phone">Phone:</label></td><td>
		<input type="text" name="phone" required></td></tr>
	<tr><td><label for="address">Address:</label></td><td>
		<textarea name="address" required></textarea></td></tr>
	<tr><td><button type='submit'>Add Customer</button></td></tr>
    </table>
	</form>
    <br>
    <form action='employee_manage_customer.php' method='post'>
		<input type='hidden' name='employee_id' value="<?php echo $employee_id; ?>">
		<button type='submit' class='return-button'>Return</button>
    </form>
	<br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_add_customer.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>
