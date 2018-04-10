<?php
include("../includes/db.php");
?>
<html>

<head>
	<style>
		#change_pass {
			padding: 5px;
			margin-top: 15px;
			margin-bottom: 10px;
			background-color: #2196F3;
			color: #fff;
		}

	</style>
</head>

<body>
	<form method="post" action="" style="padding:22px 15px;">
		<table width="60%" align="center" bgcolor="skyblue">
			<tr align="center">
				<td colspan="2">
					<h2>Change Your Password</h2>
				</td>
			</tr>
			<tr>
				<td align="right">Current Password:</td>
				<td><input type="password" name="curr_pass" required /></td>
			</tr>
			<tr>
				<td align="right">New Password:</td>
				<td><input type="password" name="new_pass" required /></td>
			</tr>
			<tr>
				<td align="right">Confirm Password:</td>
				<td><input type="password" name="con_pass" required /></td>
			</tr>
			<!--<tr align="center">
	<td colspan="2"><input type="submit" name="login" value="Login"></td>
</tr>-->
			<tr align="center">
				<td colspan="2">
					<input id="change_pass" type="submit" name="change_pass" value="Change Password">
				</td>
			</tr>
		</table>
	</form>
	<?php
	
	if(isset($_POST['change_pass'])){
		$user=$_SESSION['customer_email'];
		echo $user;
		$curr_pass=$_POST['curr_pass'];
		$new_pass=$_POST['new_pass'];
		$con_pass=$_POST['con_pass'];
		
		$change_pass="select * from customers where customer_pass='$curr_pass' AND customer_email='$user' ";
		$run_pass=mysqli_query($con,$change_pass);
		$check_pass=mysqli_num_rows($run_pass);
		if($check_pass==0){
			echo "<script>alert('Enter current password is wrong')</script>";
			exit();
		}
		if($new_pass!=$con_pass){
			echo "<script>alert('Enter new and confirm password do not match')</script>";
			
		}
		else{
			$update_pass="update customers set customer_pass='$curr_pass' where customer_email='$user'";
			$run_update=mysqli_query($con,$update_pass);
			echo "<script>alert('Password changed successfully')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		}
	}
	?>
</body>

</html>
