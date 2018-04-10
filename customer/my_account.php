<!DOCTYPE html>
<?php 
session_start();
include ("../functions/function.php");
?>

<head>
	<title>My Online Shop</title>
	<link rel="stylesheet" href="../styles/style.css" media="all" />

</head>

<body>
	<div class="main_wrapper">
		<div class="header_wrapper">
			<a href="../index.php"><img id="header_logo" src="../images/shop_logo.png"></a>

			<img id="header_adbanner" src="../images/banner2.gif">
			<div id="searchbar">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input id="query_box" type="text" name="user_query" placeholder="Search for products, brands and more">
					<input id="search_btn" type="submit" name="search" value="Search">
				</form>
			</div>
		</div>
		<div class="menubar_wrapper">
			<ul id="menu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="../all_product.php">All Product</a></li>
				<li><a href="my_account.php">My Account</a></li>
				<li><a href="#">Sign Up</a></li>
				<li><a href="#">Shopping Cart</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
		<div class="SideContentWrap">
			<div class="sidebar_wrapper">
				<h2>My Account</h2>

				<ul class="categories">
					<?php
				$user=$_SESSION['customer_email'];
				$sel_myacc="select * from customers where customer_email='$user'";
				$run_myacc=mysqli_query($con,$sel_myacc);
				$row_myacc=mysqli_fetch_array($run_myacc);
				$c_img=$row_myacc['customer_image'];
				$c_name=$row_myacc['customer_name'];
				echo "<b>Hello </b>"."<b>$c_name</b> <br>";
				echo "<img src='customer_images/$c_img' />";
				?>
						<li><a href="my_account.php?my_orders">My orders</a></li>
						<li><a href="my_account.php?edit_account">Edit Account</a></li>
						<li><a href="my_account.php?change_password">Change Password</a></li>
						<li><a href="my_account.php?delete_acount">Delete Account</a></li>
				</ul>

			</div>
			<div class="content_area">

				<?php cart(); ?>

				<div id="shopping_cart">
					<span>
						<?php
						if(isset($_SESSION["customer_email"])){
							echo "Welcome: ".$_SESSION["customer_email"]."  ";
						}
						?>
						
						

					<?php
					if(!isset($_SESSION['customer_email'])){
						echo "<a href='../checkout.php'>Login</a>";
					}
					else{
						echo "<a href='../logout.php'>Logout</a>";
					}
					?>
					</span>
				</div>

				<div id="product_box">
					<?php
					if(!isset($_GET['my_orders'])){
						if(!isset($_GET['edit_account'])){
						   if(!isset($_GET['change_password'])){
							   if(!isset($_GET['delete_acount'])){
						echo "<b>You can see your order progress by clicking on this </b><a href='#'>Link</a>";
					}
				}
			}
		}
					if(isset($_GET['edit_account'])){
						include("edit_account.php");
					}
					if(isset($_GET['change_password'])){
						include("change_password.php");
					}
					?>
				</div>
			</div>
		</div>
		<div id="footer">
			this is footer
		</div>
	</div>
</body>
