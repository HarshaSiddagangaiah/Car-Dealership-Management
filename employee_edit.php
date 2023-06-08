<?php include 'header.php'; ?>
<?php
// Retrieve customer information from previous page
  $employee_id = $_POST["employee_id"];
?>

<html>
  <head>
    <title>Employee Dashboard</title>
  </head>
  <body>
    <h2>Update Profile</h2>
    <form action="employee_profile_update.php" method="post">
      <table>
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        <tr><td><label for="employee_email">Email:</label></td><td>
        <input type="text" id="employee_email" name="employee_email" required value="<?php echo $employee_email; ?>"></td></tr>
        <tr><td><label for="employee_phone">Phone:</label></td><td>
        <input type="text" id="employee_phone" name="employee_phone" required value="<?php echo $employee_phone; ?>"></td></tr>
        <tr><td><label for="employee_address">Address:</label></td><td>
        <input type="text" id="employee_address" name="employee_address" required value="<?php echo $employee_address; ?>"></td></tr>
        <tr><td><button type="submit">Update Profile</button></td></tr>
      </table>
    </form>

    </form> <br>
    <form action='employee_profile.php' method='post'>
      <input type='hidden' name='employee_id' value="<?php echo $employee_id; ?>">
      <button type='submit' class='return-button'>Return</button>
    </form>
    <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="employee_edit.txt">Contents of the PHP page</a>
		</div>
	</footer>
    </body>
</html>