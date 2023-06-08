<?php include 'header.php'; ?>
<?php
// Connect to database
include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

$employee_id = $_POST["employee_id"];

// Get form data
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];

$sql_check = "SELECT * FROM Customers WHERE Email='$email'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        echo "An customer with same email already exists.";
    }else {
        // Insert data into table
        $sql = "INSERT INTO Customers (FirstName, LastName, Email, Phone, Address)
        VALUES ('$firstName', '$lastName', '$email', '$phone', '$address')";

        if ($conn->query($sql)) {
            echo "Customer added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    echo "<br><br>";    
    echo "<form action='employee_list_customer.php' method='post'>";
        echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
        echo "<button type='submit'>Check Customer List</button>";
        echo "</form>";
    
    echo "<br><br>";
    echo "<form action='employee_manage_customer.php' method='post'>";
        echo "<input type='hidden' name='employee_id' value='" . $employee_id . "'>";
        echo "<button type='submit' class='return-button'>Return to Manage Customers</button>";
        echo "</form>";

    echo "<br><br>";
    echo "<a href='employee_customer_addition.txt'>Contents of the PHP page</a>";
        
$conn->close();
?>
