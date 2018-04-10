<!DOCTYPE html>
<?php 
include("../includes/db.php");
?>
<html>

<head>
	<title>My Online Shop</title>
	<link rel="stylesheet" href="styles/style.css" media="all" />

	<style>
		.Customer_attr {
			text-align: right;
		}

		#customerform {
			padding: 2em;
		}

		table {
			margin-left: 22%;
			background-color: chocolate;
			border: 2px solid black;
			padding: 26px 44px;
		}

		#customerform caption {
			background-color: #FF9800;
			font-size: 1.5em;
			padding: 10px;
			border: 2px solid black;
		}

		input[type="submit"] {
			padding: 5px;
			margin-top: 15px;
			margin-bottom: -11px;
			background-color: cornflowerblue;
		}

	</style>
</head>

<body>
	<?php
				$user=$_SESSION['customer_email'];
				$sel_myacc="select * from customers where customer_email='$user'";
				$run_myacc=mysqli_query($con,$sel_myacc);
				$row_myacc=mysqli_fetch_array($run_myacc);
	
				$c_id=$row_myacc['customer_id'];
				$image=$row_myacc['customer_image'];
				$name=$row_myacc['customer_name'];
				$email=$row_myacc['customer_email'];
				$pass=$row_myacc['customer_pass'];
				$country=$row_myacc['customer_country'];
				$city=$row_myacc['customer_city'];
				$contact=$row_myacc['customer_contact'];
				$address=$row_myacc['customer_address'];
	?>

		<form id="customerform" action="" method="post" enctype="multipart/form-data">

			<table>
				<caption>Update Account Setting</caption>
				<tbody>
					<tr>
						<td class="Customer_attr">Customer Name:</td>
						<td><input type="text" name="c_name" value="<?php echo $c_name ?>" required /></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Email:</td>
						<td><input type="email" name="c_email" placeholder="Enter email" value="<?php echo $email ?>" required></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Password:</td>
						<td><input type="password" name="c_pass" placeholder="Enter Password" value="<?php echo $pass ?>" required></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Image:</td>
						<td><span><input type="file" name="c_image" value="choose file" /><img src="customer_images/<?php echo $image ?>" width="40" height="40" /></span></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Country:</td>
						<td>
							<select name="c_country" required disabled/>
							<option>
								<?php echo $country?>
							</option>
							<option>India</option>
							<option>Japan</option>
							<option>Bangladesh</option>
							<option>United Kingdom</option>
							<option>China</option>
							<option>New Zealand</option>
							<option>South Africa</option>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Customer_attr">Customer City:</td>
						<td><input type="text" name="c_city" value="<?php echo $city ?>" required/></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Contact:</td>
						<td><input type="text" name="c_contact" value="<?php echo $contact ?>" required/></td>
					</tr>
					<tr>
						<td class="Customer_attr">Customer Address:</td>
						<td><textarea name="c_address" cols="20" rows="3"><?php echo $address ?></textarea></td>
					</tr>

					<tr align="center">
						<td colspan="2"><input type="submit" name="update" value="Update" /></td>
					</tr>
				</tbody>
			</table>
		</form>
</body>

</html>

<?php
if(isset($_POST['update'])){
	$ip=getUserIpAddr();
	$customer_id=$c_id;
	$c_name=$_POST['c_name'];
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	$c_city=$_POST['c_city'];
	$c_contact=$_POST['c_contact'];
	$c_address=$_POST['c_address'];
	
	move_uploaded_file($c_image_tmp,"customer_images/$c_image");
	
	$update_cdet="update customers set customer_ip='$ip',customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image' where customer_id='$customer_id'";
	$run_update=mysqli_query($con,$update_cdet);
	if($run_update){
		echo "<script>alert('Your account has been updated successfully')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
	}
	
}

?>
