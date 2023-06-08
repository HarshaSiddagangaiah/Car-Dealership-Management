<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Profile</title>
</head>
<body>
	<?php
        // Connect to the database
        include('connectionData.txt');
        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        // Get the customer ID from the previous page
        $employee_id = $_POST["employee_id"];
        $employee_email = $_POST["employee_email"];
        $employee_phone = $_POST["employee_phone"];
        $employee_address = $_POST["employee_address"];

        $sql = "UPDATE Employees SET Email='$employee_email', Phone='$employee_phone', Address='$employee_address' WHERE EmployeeID='$employee_id'";

        // Execute SQL statement
        if ($conn->query($sql)) {
            echo "Employee table updated successfully";
            
            } else {
            echo "Error updating customer table: " . $conn->error;
        }

        // Close database connection
        $conn->close();
?>
    <br><br>
	<form action="employee_profile.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type='submit' class='return-button'>Return back to Employee Profile</button>
	</div>
    <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_profile_update.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>