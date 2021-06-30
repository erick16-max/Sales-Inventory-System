<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$pc = $_POST['prodcode'];
			$pname = $_POST['prodname'];
            $desc = $_POST['description'];
            $pr = $_POST['price'];
            $cat = $_POST['category'];
			$br = $_POST['buying'];
			$stock=$_POST['stock'];
			$onhand=$_POST['onhand'];
		
	 			$query = 'UPDATE product set NAME="'.$pname.'",
					DESCRIPTION="'.$desc.'",BUYING_PRICE="'.$br.'", PRICE="'.$pr.'",QTY_STOCK="'.$stock.'",ON_HAND="'.$onhand.'", CATEGORY_ID ="'.$cat.'" WHERE
					PRODUCT_CODE ="'.$pc.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("You've Update Product Successfully.");
			window.location = "product.php";
		</script>