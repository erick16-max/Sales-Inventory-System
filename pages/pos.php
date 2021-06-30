<?php
include'../includes/connection.php';
include'../includes/topp.php';
// session_start();
$product_ids = array();
//session_destroy();
//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'addpos')){
 
    if(isset($_SESSION['pointofsale'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['pointofsale']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['pointofsale'], 'id');

        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['pointofsale'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity'),
                'buying_price' => filter_input(INPUT_POST, 'buying_price')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['pointofsale'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['pointofsale'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity'),
            'buying_price' => filter_input(INPUT_POST, 'buying_price')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['pointofsale'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['pointofsale'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['pointofsale'] = array_values($_SESSION['pointofsale']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
                ?>
                <div class="row">
                <div class="col-lg-12">
                  <div class="card shadow mb-0">
                  <div class="card-header py-2">
                    <h4 class="m-1 text-lg text-primary">Product category</h4>
                  </div>
                        <!-- /.panel-heading -->
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                         
                            
                              <li class="nav-item" hidden>
                                <a class="nav-link" href="#" data-target="#hidden" data-toggle="tab">hidden</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#" data-target="#Files" data-toggle="tab">Files</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Notebooks" data-toggle="tab">Notebooks</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Chalks" data-toggle="tab">Chalks</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#MathematicalSets" data-toggle="tab">Mathematical Sets</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Rulers" data-toggle="tab">Rulers</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Envelopes" data-toggle="tab">Envelopes</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#ExcersiseBooks" data-toggle="tab">Exercise Books</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#CounterBook" data-toggle="tab">Counter Books</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Pens" data-toggle="tab">Pens</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Selotapes" data-toggle="tab">Selotapes</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Glue" data-toggle="tab">Glue</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Rubbers" data-toggle="tab">Rubbers</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#stapplers" data-toggle="tab">Stappler</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#Others" data-toggle="tab">Others</a>
                              </li>
                            </ul>

<!-- TAB PANE AREA - ANG UNOD KA TABS ARA SA TABPANE.PHP -->
<?php include 'postabpane.php'; ?>
<!-- END TAB PANE AREA - ANG UNOD KA TABS ARA SA TABPANE.PHP -->

        <div style="clear:both"></div>  
        <br />  
        <div class="card shadow mb-4 col-md-12">
        <div class="card-header py-3 bg-white">
          <h4 class="m-2 font-weight-bold text-primary">Point of Sale&nbsp;<i class="fa fa-shopping-cart " aria-hidden="true"></i></h4>
        </div>
        
      <div class="row">    
      <div class="card-body col-md-9">
        <div class="table-responsive">

        <!-- trial form lang   -->
<form role="form" method="post" action="pos_transac.php?action=add">
  <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
  
        <table class="table">    
        <tr>  
             <th width="55%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="15%">Price</th> 
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php 
        //Stock Availability validation
        $res=mysqli_query($db,"SELECT * FROM product") or die (mysqli_error($db));
  while($row=mysqli_fetch_assoc($res)) {     
 if(isset($_POST['addpos'])){
  foreach($_SESSION['pointofsale'] as $key => $product){
   if ($row['PRODUCT_ID']==$product['id']){
    if($product['quantity']>$row['ON_HAND'] ) {
      echo '<script>alert ("Ooops!! The Quantity added is more than the stock Availlable ")</script>';
      echo '<script>window.location="pos.php"</script>';
      unset($_SESSION['pointofsale'][$key]);
    }
   }
}
}
  }
 
 //Add Products to Cart/Point of sale
        if(!empty($_SESSION['pointofsale'])):  
            
             $total = 0;  
             
             foreach($_SESSION['pointofsale'] as $key => $product):

              echo $product['buying_price'];
              
        ?>  
        <tr>  
          <td>
            <input type="hidden" name="name[]" value="<?php echo $product['name']; ?>">
            <?php echo $product['name']; ?>
          </td>  

           <td>
            <input type="hidden" name="quantity[]" value="<?php echo $product['quantity']; ?>">
            <?php echo $product['quantity']; ?>
          </td>  

           <td>
            <input type="hidden" name="price[]" value="<?php echo $product['price']; ?>">
            ksh <?php echo number_format($product['price']); ?>
          </td> 
          
          <td style="display:none;">
            <input type="hidden" name="buying_price[]" value="<?php echo $product['buying_price']; ?>">
            ksh <?php echo number_format($product['buying_price']); ?>
          </td >  
 

           <td>
            <input type="hidden" name="total" value="<?php echo $product['quantity'] * $product['price']; ?>">
            ksh <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="pos.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn bg-gradient-danger btn-danger"><i class="fas fa-fw fa-trash"></i></div>
               </a>
           </td>  
        </tr>
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);
              
              
            
          
              
             endforeach;  
        ?>


        <?php  
        endif;
        ?>  
        </table> 
         </div>
       </div> 

<?php
include 'posside.php';
include'../includes/footer.php';
?>