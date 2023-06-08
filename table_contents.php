<?php include 'header.php'; ?>
<?php

// establish connection to database
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');


// get all table names
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

// loop through all tables and print their contents
while ($row = mysqli_fetch_row($result)) {
  echo "<strong>Table: " . $row[0] . "<br></strong>";

  // get all data from the table
  $sql2 = "SELECT * FROM " . $row[0];
  $result2 = mysqli_query($conn, $sql2);

  // print the table headers
  echo "<table><tr>";
  while ($fieldinfo = mysqli_fetch_field($result2)) {
    echo "<th>" . $fieldinfo->name . "</th>";
  }
  echo "</tr>";

  // print the table rows
  while ($row2 = mysqli_fetch_row($result2)) {
    echo "<tr>";
    foreach ($row2 as $value) {
      echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
  }

  echo "</table><br>";
}

// close connection
mysqli_close($conn);

?>
