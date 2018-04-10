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
			<img id="header_logo" src="images/shop_logo.png">

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
				<li><a href="#">Home</a></li>
				<li><a href="#">All Product</a></li>
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
					<?php 
	if(isset($_GET['product_id'])){		
	$product_id=$_GET['product_id'];
	$get_prod="select * from product where product_id='$product_id' ";
	$run_prod=mysqli_query($con,$get_prod);
	
	while($row_cat_prod=mysqli_fetch_array($run_prod)){
		$product_id=$row_cat_prod['product_id'];
		$product_cat=$row_cat_prod['product_cat'];
		$product_brand=$row_cat_prod['product_brand'];
		$product_tittle=$row_cat_prod['product_tittle'];
		$product_price=$row_cat_prod['product_price'];
		$product_desc=$row_cat_prod['product_desc'];
		$product_image=$row_cat_prod['product_image'];		
		
		echo "
		<div id='single_product' style='width:52%'>
		<h3>$product_tittle</h3>
		<img src='admin_area/product_images/$product_image' style='width:100%; height:16em'/>
		<p><b>Price: ₹ $product_price</b></p>
		<p>$product_desc</p>
		<a href='index.php?product_id=$product_id' float:left>Go Back</a>
		<a href='index.php?product_id=$product_id' id='addtocart'><button>Add to cart</button></a>
		</div>		
		";
	}
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
