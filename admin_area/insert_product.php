<!DOCTYPE html>
<?php
include ("includes/db.php");
?>
	<html>

	<head>
		<title>InsertProducts</title>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
		<script>
			tinymce.init({
				selector: 'textarea'
			});

		</script>

		<style>
			body {
				background-color: lightseagreen;
			}

			.Prod_attr {
				text-align: right;
			}

			#insertform {
				padding: 4em;
			}

			table {
				margin-left: 22%;
				background-color: chocolate;
				border: 2px solid black;
				padding: 26px 44px;
			}

			#insertform caption {
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
		<form id="insertform" action="insert_product.php" method="post" enctype="multipart/form-data">
			<!--<h2>Insert new post here</h2>-->
			<table>
				<caption>Insert new post here</caption>
				<tbody>
					<tr>
						<td class="Prod_attr">Product Title:</td>
						<td><input type="text" name="product_title" required /></td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Category:</td>
						<td><select name="product_cat" required>
						<option >Select a category</option>
						<?php
												
						$get_cats="select * from categories";
						$run_cats=mysqli_query($con,$get_cats);	
						while($row_cats=mysqli_fetch_array($run_cats)){
						$cat_id=$row_cats['cat_id'];
						$cat_title=$row_cats['cat_title'];
						echo "<option value='$cat_id'>$cat_title</option>" ;
						}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Brand:</td>
						<td>
							<select name="product_brand" required>
						<option >Select a Brand</option>
						<?php
						$get_brand="select * from brands";
						$run_brand=mysqli_query($con,$get_brand);
	
						while($row_brand=mysqli_fetch_array($run_brand)){
						$brand_id=$row_brand['brand_id'];
						$brand_title=$row_brand['brand_title'];
						echo "<option value='$brand_id'>$brand_title</option>";
	}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Image:</td>
						<td><input type="file" name="product_img" value="choose file" required/></td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Price:</td>
						<td><input type="text" name="product_price" required/></td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Description:</td>
						<td><textarea name="product_desc" cols="15" rows="10"></textarea></td>
					</tr>
					<tr>
						<td class="Prod_attr">Product Keywords:</td>
						<td><input type="text" name="product_keywords" required/></td>
					</tr>
					<tr align="center">
						<td colspan="2"><input type="submit" name="insert_post" value="Insert New Product" /></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>

	</html>
	<?php
//getting the data 
if(isset($_POST["insert_post"])){
	$product_title=$_POST['product_title'];
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];	
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$product_keyword=$_POST['product_keywords'];
	
	 //getting the image
	$product_img=$_FILES['product_img']['name'];
	$product_img_tmp=$_FILES['product_img']['tmp_name'];
	
	move_uploaded_file($product_img_tmp,"product_images/$product_img");
	//insert the product into table 
	$insert_product="insert into product(product_cat,product_brand,product_tittle,product_price,	product_desc,product_image,product_keyword) values('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_img','$product_keyword')";
	
	$insert_pro=mysqli_query($con,$insert_product);
	if($insert_pro){
	echo "<script>alert('Product has been inserted!')</script>";
	echo "<script>window.open('insert_product.php','_self')</script>";
	}
}
?>
