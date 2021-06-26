<?php
include'../includes/connection.php';

if(isset($_GET['id'])){
	$id= $_GET['id'];
	
	  
	
	$query="DELETE FROM product WHERE PRODUCT_ID=$id";
	$results=mysqli_query($db,$query) or die (mysqli_error($db));
	
		
	
		?>
		<script>
		window.location="product.php";
		</script>
		<?php
}
?>