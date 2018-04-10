<!DOCTYPE html>
<?php 
session_start();
include ("functions/function.php");
include("includes/db.php");
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
	<div class="main_wrapper">
		<div class="header_wrapper">
			<a href="index.php"><img id="header_logo" src="images/shop_logo.png"></a>

			<img id="header_adbanner" src="images/banner2.gif">
			<div id="searchbar">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input id="query_box" type="text" name="user_query" placeholder="Search for products, brands and more">
					<input id="search_btn" type="submit" name="search" value="Search">
				</form>
			</div>
		</div>
		<div class="menubar_wrapper">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_product.php">All Product</a></li>
				<li><a href="#">My Account</a></li>
				<li><a href="#">Sign Up</a></li>
				<li><a href="#">Shopping Cart</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
		<div class="SideContentWrap">
			<div class="sidebar_wrapper">
				<h2>Categories</h2>
				<ul class="categories">
					<?php getCats(); ?>
				</ul>
				<h2>Brands</h2>
				<ul class="categories">
					<?php getbrand(); ?>
				</ul>
			</div>
			<div class="content_area">

				<?php cart(); ?>

				<div id="shopping_cart">
					<span>Welcome to user! <b> Shopping Cart- </b>Total Item:<?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" >Go to Cart</a></span>
				</div>

				<form id="customerform" action="customer_register.php" method="post" enctype="multipart/form-data">

					<table>
						<caption>Create New Account</caption>
						<tbody>
							<tr>
								<td class="Customer_attr">Customer Name:</td>
								<td><input type="text" name="c_name" required /></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Email:</td>
								<td><input type="email" name="c_email" placeholder="Enter email" required></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Password:</td>
								<td><input type="password" name="c_pass" placeholder="Enter Password" required></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Image:</td>
								<td><input type="file" name="c_image" value="choose file" required/></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Country:</td>
								<td>
									<select name="c_country" required>
									<option >Select a Country</option>
									<option >India</option>
										<option >Japan</option>
										<option >Bangladesh</option>
										<option >United Kingdom</option>
										<option >China</option>
										<option >New Zealand</option>
										<option >South Africa</option>					
									</select>
								</td>
							</tr>

							<tr>
								<td class="Customer_attr">Customer City:</td>
								<td><input type="text" name="c_city" required/></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Contact:</td>
								<td><input type="text" name="c_contact" required/></td>
							</tr>
							<tr>
								<td class="Customer_attr">Customer Address:</td>
								<td><textarea name="c_address" cols="20" rows="10"></textarea></td>
							</tr>

							<tr align="center">
								<td colspan="2"><input type="submit" name="register" value="Create Acoount" /></td>
							</tr>
						</tbody>
					</table>
				</form>

			</div>
		</div>
		<div id="footer">
			this is footer
		</div>
	</div>
</body>

</html>

<?php
if(isset($_POST['register'])){
	$ip=getUserIpAddr();
	$c_name=$_POST['c_name'];
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	$c_country=$_POST['c_country'];
	$c_city=$_POST['c_city'];
	$c_contact=$_POST['c_contact'];
	$c_address=$_POST['c_address'];
	
	move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
	
	$insert_cdet="insert into customers (customer_ip,customer_name,customer_email	,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	$run_cdet=mysqli_query($con,$insert_cdet);
	$sel_cart="select * from cart where ip_addrs='$ip'";
	$run_cart=mysqli_query($con,$sel_cart);
	$check_cart=mysqli_num_rows($run_cart);
	
	if($check_cart==0){
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Registration Successful')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
	}
	else{
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('Registration Successful')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
	
	
}

?>
