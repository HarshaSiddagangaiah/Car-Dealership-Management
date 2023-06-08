<?php include 'header.php'; ?>
<?php

    // Connect to the database

    include('connectionData.txt');

    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
    or die('Error connecting to MySQL server.');

    // Retrieve the EmployeeID from the previous page
    $employee_id = $_POST['employee_id'];

    // Retrieve the appointment details from the form
    $maintenancetype = $_POST['maintenancetype'];
    $maintenancecost = $_POST['maintenancecost'];

    // Check if the appointment already exists
    $sql_check = "SELECT * FROM MaintenanceTypes WHERE MaintenanceType='$maintenancetype'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        echo "An maintenance of same type already exists.";
    }else {
    // Insert the appointment details into the Appointments table
        $sql = "INSERT INTO MaintenanceTypes (MaintenanceType, MaintenanceCost)
                VALUES ('$maintenancetype', '$maintenancecost')";

        if ($conn->query($sql)) {
            echo "Maintenance Package added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    echo "<br><br>";
    echo "<form action='employee_list_maintenancepackages.php' method='post'>";
    echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
    echo "<button type='submit'>List Maintenance Packages</button>";
    echo "</form>";
    
    echo "<br><br>";
    echo "<form action='employee_manage_maintenancetypes.php' method='post'>";
    echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
    echo "<button type='submit' class='return-button'>Return to Manage Maintenance Packages</button>";
    echo "</form>";

    echo "<br><br>";
    echo "<a href='employee_add_maintenancepackages_success.txt'>Contents of the PHP page</a>";

    // Close the database connection
    $conn->close();

?>
