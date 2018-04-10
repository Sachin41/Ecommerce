<!DOCTYPE html>
<?php 
session_start();
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

				<?php cart(); ?>

				<div id="shopping_cart">
					<span>
						<?php
						if(isset($_SESSION["customer_email"])){
							echo "Welcome: ".$_SESSION["customer_email"]."Your ";
						}else{
							echo "Welcome Guest";
						}
						?>
						
						<b> Shopping Cart- </b>Total Item:<?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="index.php" >Back to shop</a>
					</span>
				</div>

				<div id="product_box">
					<form action="" method="post" enctypt="multipart/formdata">
						<table align="center" bgcolor="skyblue" width="100%">
							<tr align="center">
								<th>Remove</th>
								<th>Product(S)</th>
								<th>Quantity</th>
								<th>Price/item</th>
								<th>Sub Total</th>
							</tr>



							<?php
		$total=0;
		$subtotal=0;
		global $con;
		$ip=getUserIpAddr();
		$sel_price="select * from cart where ip_addrs='$ip'";
		$run_query=mysqli_query($con,$sel_price);
		while($p_price=mysqli_fetch_array($run_query)){
			$cpro_id=$p_price['p_id'];
			$cpro_item="select * from product where product_id='$cpro_id'";
			$run_item=mysqli_query($con,$cpro_item);
			while($p_product=mysqli_fetch_array($run_item)){
				$single_price=$p_product['product_price'];
				/*$qty=$_POST['qty']; $subtotal=$single_price*$qty; $product_price=array($subtotal);*/
				
				$product_title=$p_product['product_tittle'];
				$product_image=$p_product['product_image'];			

				?>
								<tr align="center">
									<td><input type="checkbox" name="remove[]" value="<?php echo $cpro_id ?>"></td>
									<td>
										<?php echo $product_title ?>
										<br>
										<img src="admin_area/product_images/<?php echo $product_image?>" width="60px" height="60px" />

									</td>
									<td><input type="text" name="qty" size="3px" value="<?php echo $_SESSION['p_qty']; ?>">
									</td>

									<?php
					
									$ip=getUserIpAddr();
									if(isset($_POST['update_cart'])){
									
									$qty=$_POST['qty'];
									$update_qty="update cart set p_qty='$qty' ";
									$run_qty=mysqli_query($con, $update_qty);
									$_SESSION['p_qty']=$qty;
										$subtotal+=$single_price*$qty;
										$product_price=array($subtotal);
				$values=array_sum($product_price); 
				$total+=$values;
									
									
									}
									?>
										<td>
											<?php echo "₹".$single_price ?>
										</td>

										<td>
											<?php echo "₹".$subtotal?>
										</td>
								</tr>

								<?php } } ?>
								<tr align="center">
									<td></td>
									<td></td>
									<td><b>Grand total:</b></td>
									<td>
										<b><?php echo "₹".$total ?></b>
									</td>
								</tr>
								<tr align="center">
									<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
									<td><input type="submit" name="continue" value="Continue Shopping"></td>
									<td><button><a href="checkout.php" style="text-decoration:none; color:black;" >Checkout</a></button>
									</td>
								</tr>
						</table>
					</form>
					<?php
					function update_cart(){
					global $con;
					$ip=getUserIpAddr();
					if(isset($_POST['update_cart'])){						
						foreach($_POST['remove'] as $remove_id){
						$delete_prod="delete from cart where p_id='$remove_id' and ip_addrs='$ip' ";
						$run_delete=mysqli_query($con,$delete_prod);
							if($run_delete){
							echo "<script>window.open('cart.php','_self')</script>";
							}
						}
					}
}
					if(isset($_POST['continue'])){
						echo "<script>window.open('index.php','_self')</script>";
						}
					
					echo @$up_cart=update_cart();
					
					?>

				</div>
			</div>
		</div>
		<div id="footer">
			this is footer
		</div>
	</div>
</body>
