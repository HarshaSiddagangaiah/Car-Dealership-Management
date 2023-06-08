<?php include 'header.php'; ?>
<html>
  <head>
    <title>Employee Dashboard</title>
  </head>
  <body>
      <?php
        // Database connection details
        include('connectionData.txt');

        $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');

        $employee_id = $_POST["employee_id"];

        // Query to retrieve customer details
        $sql = "SELECT FirstName FROM Employees Where EmployeeID=$employee_id";

        // Execute query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<h2>Welcome to your Dashboard, ' . $row["FirstName"] .'!</h2>';
            
          }
        } else {
          echo "No employees found";
        }

        // Close database connection
        $conn->close();
      ?>

    <form action="employee_profile.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type="submit">Manage Employee Profile</button>
    </form>
    <br>
    <form action="employee_manage_customer.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type="submit">Manage Customers</button>
    </form>
    <br>
    <form action="employee_manage_car.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type="submit">Manage Cars</button>
    </form>
    <br>
    <form action="employee_manage_appointments.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type="submit">Manage Appointments</button>
    </form>
    <br>
    <form action="employee_manage_maintenancetypes.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type="submit">Manage Maintenance Packages</button>
    </form>
    <br><br>
    <form action='employee_login.php' method='post'>
      <button type='submit' class='return-button'>Return</button>
    </form>
    <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_dashboard.txt">Contents of the PHP page</a>
		</div>
	</footer>
  </body>
</html>
