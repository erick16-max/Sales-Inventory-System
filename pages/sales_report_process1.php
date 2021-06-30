<?php
include '../includes/connection.php';
include '../includes/sidebar.php';


?>


<?php

  $query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = ' . $_SESSION['MEMBER_ID'] . '';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));

  while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['TYPE'];

    if ($Aa == 'User') {

  ?> <script type="text/javascript">
  //then it will be redirected
  alert("Restricted Page! You will be redirected to POS");
  window.location = "pos.php";
</script>
<?php   }
  }
?>

<?php
if (isset($_POST['submit'])) {
  $tbp=0;
  $tsp=0;
  $startDate = mysqli_real_escape_string($db, $_POST['start-date']);
  $endDate = mysqli_real_escape_string($db, $_POST['end-date']);

  $sql =  "SELECT d.TRANS_D_ID,t.DATE,d.PRODUCTS,d.QTY,d.BUYING_PRICE,d.PRICE,
           BUYING_PRICE * QTY AS Total_Buying_Price, PRICE * QTY AS Total_Selling_Price 
           FROM transaction_details d JOIN transaction t ON d.TRANS_D_ID=t.TRANS_D_ID
            WHERE t.DATE BETWEEN '{$startDate}' AND '{$endDate}' 
            ORDER BY DATE(t.DATE) DESC";
  $results3 = mysqli_query($db, $sql) or die(mysqli_error($db));
  $count = mysqli_num_rows($results3);
  
  
  
 


  if ($count == '0') {
    echo '<h5 class="alert alert-danger"> No Transaction Details on selected date</h5>';
  } else {




?>

    <div class="card shadow d-print-inline">
      <div id="card-body" class="card-body">
        <div class="form-group row text-left mb-0">
          <div class="col-sm-6 mx-auto">
            <h5 class="font-weight-bold ">
              Mwamba Cybers Inventory System - Sales Report
            </h5>
          </div>
        </div>
        <div class="form-group row text-left mb-0">
          <div class="col-sm-4 py-1 mx-auto">
            <h6>
              Date: <?php echo $startDate; ?> To <?php echo $endDate; ?>
            </h6>
          </div>
        </div>


        <table class="table table-striped ">
          <thead>
            <tr>
              <th >Trans_ID</th>
              <th >Date</th>
              <th >Product</th>
              <th >Quantity</th>
              <th >B.Price</th>
              <th >S.Price</th>
              <th >Quantinty Bought</th>
              <th >Quantity Sold</th>
            </tr>
          </thead>
          <tbody>
            <?php
         
            while ($row=mysqli_fetch_assoc($results3)) {
              


              echo '<tr >';
              echo '<td >' . $row['TRANS_D_ID'] . '</td>';
              echo '<td >' . $row['DATE'] . '</td>';
              echo '<td >' . $row['PRODUCTS'] . '</td>';
              echo '<td  >' . $row['QTY'] . '</td>';
              echo '<td  >' . $row['BUYING_PRICE'] . '</td>';
              echo '<td  >' . $row['PRICE'] . '</td>';
              echo '<td >' . $row['Total_Buying_Price'] . '</td>';
              echo '<td >' . $row['Total_Selling_Price'] . '</td>';


              echo '</tr> ';
               
               $tbp +=$row['Total_Buying_Price'];
               $tsp +=$row['Total_Selling_Price'];
               //$tbp +=$tbp;
               //$tsp +=$tsp;
               $profit= $tsp-$tbp;
              $tithe= 0.1*$profit;
              $net_profit=$profit -$tithe;
              
            
             
            
              
            }
          
            ?>
               <tr>
              <td colspan="6"></td>
                <td class="font-weight-bold">Total Sales</td>
                <td class="font-weight-bold text-right ">ksh. <?php echo number_format($tsp,2) ;?> </td>
              </tr>
              <tr>
              <td colspan="6"></td>
                <td class="font-weight-bold">Total Buyings</td>
                <td class="font-weight-bold text-right ">ksh. <?php echo number_format($tbp,2);?> </td>
              </tr>
              <tr>
              <td colspan="6"></td>
                <td class="font-weight-bold">Gross Profit</td>
                <td class="font-weight-bold text-right ">ksh. <?php echo number_format($profit,2) ;?> </td>
              </tr>
              <tr>
              <td colspan="6"></td>
                <td class="font-weight-bold">Tithe (10%)</td>
                <td class="font-weight-bold text-right ">ksh. <?php echo number_format($tithe,2);?> </td>
              </tr>
              <tr>
              <td colspan="6"></td>
                <td class="font-weight-bold">Net Profit</td>
                <td class="font-weight-bold text-right ">ksh. <?php echo number_format($net_profit,2);?> </td>
              </tr>
              
          </tbody>
        </table>


      </div>
    </div>

<?php

  }
} ?>


<button id="" onclick="javascript:printlayer()" class="btn btn-primary mb-8"><i class="fas fa-print"></i>Print Report</button>



<script type="text/javascript">
//printing function
  function printlayer(layer)
{
  var prtContent = document.getElementById("card-body");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}

</script>

<?php
include '../includes/footer.php';
?>
</body>

</html>