<?php
//connectivity to the database

$con= mysqli_connect("localhost","root","","ecommerce");
if(mysqli_connect_errno()){
	echo "The connection was not established: ". mysqli_connect_error();
}

// getting the categories

function getCats(){
	global $con;
	$get_cats="select * from categories";
	$run_cats=mysqli_query($con,$get_cats);	
	while($row_cats=mysqli_fetch_array($run_cats)){
		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];
		echo "<li><a href='index.php?cat_id=$cat_id'>$cat_title</a></li>" ;
	}
}


// getting the brands 

function getbrand(){
	
	global $con;
	$get_brand="select * from brands";
	$run_brand=mysqli_query($con,$get_brand);
	
	while($row_brand=mysqli_fetch_array($run_brand)){
		$brand_id=$row_brand['brand_id'];
		$brand_title=$row_brand['brand_title'];
		echo "<li><a href='index.php?brand_id=$brand_id'>$brand_title</a></li>" ;
	 }
    }


//getting the product from db

function get_product(){
	if(!isset($_GET['cat_id'])){
		if(!isset($_GET['brand_id'])){
	global $con;
	$get_prod="select * from product order by RAND() limit 0,6 ";
	$run_prod=mysqli_query($con,$get_prod);
	
	while($row_prod=mysqli_fetch_array($run_prod)){
		$product_id=$row_prod['product_id'];
		$product_cat=$row_prod['product_cat'];
		$product_brand=$row_prod['product_brand'];
		$product_tittle=$row_prod['product_tittle'];
		$product_price=$row_prod['product_price'];
		$product_desc=$row_prod['product_desc'];
		$product_image=$row_prod['product_image'];
		$product_keyword=$row_prod['product_keyword'];
		
		echo "
		<div id='single_product'>
		<h3>$product_tittle</h3>
		<img src='admin_area/product_images/$product_image'/>
		<p><b>Price: ₹ $product_price</b></p>
		<a href='details.php?product_id=$product_id' float:left>Details</a>
		<a href='index.php?add_cart=$product_id' id='addtocart'><button>Add to cart</button></a>
		</div>		
		";
		}
	}	
	}
}

//getting the product by category from db

function getCatProd(){
	if(isset($_GET['cat_id'])){
	$cat_id=$_GET['cat_id'];
	global $con;
	$get_cat_prod="select * from product where product_cat=$cat_id ";
	$run_cat_prod=mysqli_query($con,$get_cat_prod);
	$count_cat= mysqli_num_rows($run_cat_prod);
		if($count_cat==0){
			echo "<h2 style='padding:10px'>!No Product were found in this category</h2>";
		}
	
	while($row_cat_prod=mysqli_fetch_array($run_cat_prod)){
		$product_id=$row_cat_prod['product_id'];
		$product_cat=$row_cat_prod['product_cat'];
		$product_brand=$row_cat_prod['product_brand'];
		$product_tittle=$row_cat_prod['product_tittle'];
		$product_price=$row_cat_prod['product_price'];		
		$product_image=$row_cat_prod['product_image'];		
		
		echo "
		<div id='single_product'>
		<h3>$product_tittle</h3>
		<img src='admin_area/product_images/$product_image'/>
		<p><b>Price: ₹ $product_price</b></p>
		<a href='details.php?product_id=$product_id' float:left>Details</a>
		<a href='index.php?product_id=$product_id' id='addtocart'><button>Add to cart</button></a>
		</div>		
		";
		}
	}	
	}


//getting the product by brand from db

function getBrandProd(){
	if(isset($_GET['brand_id'])){
	$brand_id=$_GET['brand_id'];
	global $con;
	$get_brand_prod="select * from product where product_brand=$brand_id ";
	$run_brand_prod=mysqli_query($con,$get_brand_prod);
	$count_brand= mysqli_num_rows($run_brand_prod);
		if($count_brand==0){
			echo "<h2 style='padding:10px'>!No Product were found in this Brand</h2>";
		}
	
	while($row_brand_prod=mysqli_fetch_array($run_brand_prod)){
		$product_id=$row_brand_prod['product_id'];
		$product_cat=$row_brand_prod['product_cat'];
		$product_brand=$row_brand_prod['product_brand'];
		$product_tittle=$row_brand_prod['product_tittle'];
		$product_price=$row_brand_prod['product_price'];		
		$product_image=$row_brand_prod['product_image'];		
		
		echo "
		<div id='single_product'>
		<h3>$product_tittle</h3>
		<img src='admin_area/product_images/$product_image'/>
		<p><b>Price: ₹ $product_price</b></p>
		<a href='details.php?product_id=$product_id' float:left>Details</a>
		<a href='index.php?product_id=$product_id' id='addtocart'><button>Add to cart</button></a>
		</div>		
		";
		}
	}	
	}

// getting the User Ip Address

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// creating the shopping cart

 function cart(){
	 if(isset($_GET['add_cart'])){
		 global $con;
		 
		 $prod_id=$_GET['add_cart'];		 
		 $ip=getUserIpAddr();

		 $check_prod="select * from cart where ip_addrs='$ip' and p_id='$prod_id'";
		 $run_check=mysqli_query($con,$check_prod);
		 if(mysqli_num_rows($run_check)>0){
			 echo " ";
		 }
		 else{
			 global $con;
			 $insert_prod="insert into cart (p_id,ip_addrs) values('$prod_id','$ip')";
			 $run_prod=mysqli_query($con,$insert_prod);
			/* $insert_price="insert into cart(p_price) select product.product_price from product where product.product_id=cart.p_id";*/
			 $run_price=mysqli_query($con,$insert_price);
			 echo "<script>window.open('index.php','_self')</script>";
		 }
		 
	 }
 }


//getting the total added items

function total_items(){
	if(isset($_GET['add_cart'])){
		global $con;
		$ip=getUserIpAddr();
		$get_items="select * from cart where ip_addrs='$ip'";
		$run_query=mysqli_query($con,$get_items);
		$count_items=mysqli_num_rows($run_query);		
	}
	else{
		global $con;
		$ip=getUserIpAddr();
		$get_items="select * from cart where ip_addrs='$ip'";
		$run_query=mysqli_query($con,$get_items);
		$count_items=mysqli_num_rows($run_query);		
	}	
	echo $count_items;
}

function total_price(){
	$total=0;
		global $con;
		$ip=getUserIpAddr();
		$sel_price="select * from cart where ip_addrs='$ip'";
		$run_query=mysqli_query($con,$sel_price);
		while($p_price=mysqli_fetch_array($run_query)){
			$cpro_id=$p_price['p_id'];
			$cpro_item="select * from product where product_id='$cpro_id'";
			$run_item=mysqli_query($con,$cpro_item);
			while($p_product=mysqli_fetch_array($run_item)){
				$product_price=array($p_product['product_price']);
				$values=array_sum($product_price);
				$total+=$values;
				
			}
		}
	echo "₹".$total;
}
?>
