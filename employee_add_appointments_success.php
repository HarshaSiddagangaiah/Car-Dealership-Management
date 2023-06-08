<?php include 'header.php'; ?>
<?php

    // Connect to the database

    include('connectionData.txt');

    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
    or die('Error connecting to MySQL server.');

    // Retrieve the EmployeeID from the previous page
    $employee_id = $_POST['employee_id'];

    // Retrieve the appointment details from the form
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $appointmentType = $_POST['appointmentType'];

    // Check if the appointment already exists
    $sql_check = "SELECT * FROM Appointments WHERE EmployeeID='$employee_id' AND AppointmentDate='$appointmentDate' AND AppointmentTime='$appointmentTime'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        echo "An appointment with the same date and time already exists for this employee.";
    }else {
    // Insert the appointment details into the Appointments table
        $sql = "INSERT INTO Appointments (EmployeeID, AppointmentDate, AppointmentTime, AppointmentType)
                VALUES ('$employee_id', '$appointmentDate', '$appointmentTime', '$appointmentType')";

        if ($conn->query($sql)) {
            echo "Appointment added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "<br><br>";
    echo "<form action='employee_list_appointments.php' method='post'>";
    echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
    echo "<button type='submit'>List Appointments</button>";
    echo "</form>";
    
    echo "<br><br>";
    echo "<form action='employee_manage_appointments.php' method='post'>";
    echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
    echo "<button type='submit' class='return-button'>Return to Manage Appointments</button>";
    echo "</form>"; 

    echo "<br><br>";
    echo "<a href='employee_add_appointments_success.txt'>Contents of the PHP page</a>";
    // Close the database connection
    $conn->close();



?>
