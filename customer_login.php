<?php
include("includes/db.php");
?>
<div>
	<form method="post" action="" style="padding:22px 10px;">
		<table width="60%" align="center" bgcolor="skyblue">
			<tr align="center">
				<td colspan="2">
					<h2>Login or Register to Buy!</h2>
				</td>
			</tr>
			<tr>
				<td align="right">Email:</td>
				<td><input type="email" name="email" placeholder="Enter email" required/></td>
			</tr>
			<tr>
				<td align="right">Password:</td>
				<td><input type="password" name="pass" placeholder="Enter Password"></td>
			</tr>
			<tr align="center">
				<td colspan="2"><a href="checkout.php?forget_pass">Forget Password?</a></td>
			</tr>
			<tr align="center">
				<td colspan="2"><input type="submit" name="login" value="Login"></td>
			</tr>
			<tr align="center">
				<td colspan="2">
					<button><a href="customer_register.php" style="text-decoration:none;">New?Sign Up</a></button>
				</td>
			</tr>
		</table>
	</form>

	<?php
	if(isset($_POST['login'])){
		$c_email=$_POST['email'];
		$c_pass=$_POST['pass'];
		$sel_cus="select * from customers where customer_pass='$c_pass' AND customer_email='$c_email' ";
		$run_cus=mysqli_query($con,$sel_cus);
		$check_cus=mysqli_num_rows($run_cus); 
		if($check_cus==0){
			echo "<script>alert('No user exist with this email, Please try again')</script>";
			exit();
		}
		
		$ip=getUserIpAddr();
		$sel_cart="select * from cart where ip_addrs='$ip' ";
		$run_cart=mysqli_query($con, $sel_cart);
		$check_cart=mysqli_num_rows($run_cart);
		if($check_cus>0 and $check_cart==0){
			$_SESSION['customer_email']=$c_email;
			
			echo "<script>alert('You logged in successfully')</script>";
			echo "<script>window.open('customer/my_account.php','_self')</script>";
		}
		else{
			$_SESSION['customer_email']=$c_email;
			
			echo "<script>alert('You logged in successfully')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
	}
	?>
</div>
