<!DOCTYPE html>
<?php 
include ("functions/function.php");
?>

<head>
	<title>My Online Shop</title>
	<link rel="stylesheet" href="styles/style.css" media="all" />

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
				<div id="shopping_cart">
					<span>Welcome to user! <b> Shopping Cart- </b>Total Item: Total Price: <a href="cart.php" >Go to Cart</a></span>
				</div>
				<div id="product_box">
					<?php get_product(); ?>
					<?php getCatProd(); ?>
					<?php getBrandProd();?>
				</div>
			</div>
		</div>
		<div id="footer">
			this is footer
		</div>
	</div>
</body>
