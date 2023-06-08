<?php include 'header.php'; ?>
<?php
// Retrieve customer information from previous page
  $customer_id = $_POST["customer_id"];
?>

<html>
  <head>
    <title>Customer Dashboard</title>
  </head>
  <body>
    <h2>Update Profile</h2>
    
    <form action="customer_profile_update.php" method="post">
    <table>
      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
      <tr><td><label for="customer_email">Email:</label></td><td>
      <input type="text" id="customer_email" name="customer_email" required value="<?php echo $customer_email; ?>"></td></tr>
      <tr><td><label for="customer_phone">Phone:</label></td><td>
      <input type="text" id="customer_phone" name="customer_phone" required value="<?php echo $customer_phone; ?>"></td></tr>
      <tr><td><label for="customer_address">Address:</label></td><td>
      <input type="text" id="customer_address" name="customer_address" required value="<?php echo $customer_address; ?>"></td></tr>
      <tr><td><button type="submit">Update Profile</button></td></tr>
      
    </table>
    </form><br>
    <form action='customer_profile.php' method='post'>
      <input type='hidden' name='customer_id' value="<?php echo $customer_id; ?>">
      <button type="submit" class='return-button'>Return</button>
    </form>
    <br><br>
	<footer>
		<div style="text-align:bottom;">
			<a href="customer_edit.txt">Contents of the PHP page</a>
		</div>
	</footer>
    </body>
</html>