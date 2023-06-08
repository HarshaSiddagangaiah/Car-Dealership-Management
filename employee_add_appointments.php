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
    <title>Add Appointment</title>
</head>
<body>
    <h2>Add Appointment</h2>
    <form method="post" action="employee_add_appointments_success.php">
        <input type="hidden" name="employee_id" value="<?php echo $_POST['employee_id']; ?>">

        
        <label for="appointmentDate">Appointment Date:</label>
        <select name="appointmentDate" id="appointmentDate" required>
            <option value="">Select Date</option>
            <?php
            for ($i = 1; $i <= 30; $i++) {
                $day = str_pad($i, 2, "0", STR_PAD_LEFT);
                echo "<option value='2023-04-$day'>2023-04-$day</option>";
            }
            ?>
        </select><br><br>


        <label for="appointmentTime">Appointment Time:</label>
        <select name="appointmentTime" id="appointmentTime" required>
            <option value="">Select Type</option>
            <?php
            $start_time = strtotime('9:00');
            $end_time = strtotime('17:00');
            $interval = strtotime('30 minutes', 0);
            for ($i = $start_time; $i <= $end_time; $i = strtotime('+30 minutes', $i)) {
                echo "<option value='" . date('H:i:s', $i) . "'>" . date('h:i A', $i) . "</option>";
            }
            ?>
        </select><br><br>

        <label for="appointmentType">Appointment Type:</label>
        <select name="appointmentType" id="appointmentType" required>
			<option value="">Select Type</option>
			<option value="Maintenance">Maintenance</option>
			<option value="Test Drive">Test Drive</option>
		</select><br><br>
        <br>
        <button type='submit'>Add Appointment</button>
    </form>
    <br>
	<form action="employee_manage_appointments.php" method="post">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
      <button type='submit' class='return-button'>Return</button>
    </form>
    <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_add_appointments.txt">Contents of the PHP page</a>
		</div>
	</footer>
</body>
</html>