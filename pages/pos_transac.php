<?php
include'../includes/connection.php';
session_start();

              $date = $_POST['date'];
             // $customer = $_POST['customer'];
              $subtotal = $_POST['subtotal'];
              $lessvat = $_POST['lessvat'];
              $netvat = $_POST['netvat'];
              $addvat = $_POST['addvat'];
              $total = $_POST['total'];
              $cash = $_POST['cash'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              $cash=$_POST['cash'];
              $bal=$cash-$total;
              //imma make it trans uniq id
              $today = date("mdGis"); 
              
              $countID = count($_POST['name']);
              // echo "<table>";
              
              switch($_GET['action']){
             
                case($cash<$total):
                  ?>
                  <script>
                  alert ('Amount too low \ntop up the cash !!');

                  window.location="pos.php";
                  </script>
                  
                  <?php

                case 'add':  
                 
                for($i=1; $i<=$countID; $i++)
                  {
                    // echo "'{$today}', '".$_POST['name'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}' <br>";

                    $query = "INSERT INTO `transaction_details`
                               (`ID`, `TRANS_D_ID`, `PRODUCTS`, `QTY`, `PRICE`, `EMPLOYEE`, `ROLE`)
                               VALUES (Null, '{$today}', '".$_POST['name'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}')";

                    mysqli_query($db,$query)or die (mysqli_error($db));

                    }
                    $query111 = "INSERT INTO `transaction`
                               (`TRANS_ID`, `CUST_ID`, `NUMOFITEMS`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
                               VALUES (Null,NULL,'{$countID}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}')";
                    mysqli_query($db,$query111)or die (mysqli_error($db));

               
                break;
                  
              }
              
              ?>
              <script type="text/javascript">
        // alert("Billing transaction completed successfully!! /n Balance");
         alert("Transaction Completed Successfully!!\n\nCustomer Balance: ksh<?php echo number_format($bal,2);?>");
         window.location = "pos.php";
       </script>
             <?php
           
                    unset($_SESSION['pointofsale']);
               ?>
             
          </div>



























<?php
              // switch($_GET['action']){
              //   case 'add':     
              //       $query = "INSERT INTO transaction_details
              //                  (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                  VALUES (Null, 'here', '{$emp}', '{$rol}')";
              //       mysqli_query($db,$query)or die ('Error in Database '.$query);
              //       $query2 = "INSERT INTO `transaction`
              //                  (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
              //                  VALUES (Null,'{$customer}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}'')";
              //       mysqli_query($db,$query2)or die ('Error in updating Database2 '.$query2);
              //   break;
              // }

              // mysqli_query($db,"INSERT INTO transaction_details
              //                 (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                 VALUES (Null, 'a', '{$emp}', '{$rol}')");

              // mysqli_query($db,"INSERT INTO `transaction`
              //                 (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_DETAIL_ID`)
              //                 VALUES (Null,'{$customer}',{$subtotal},{$lessvat},{$netvat},{$addvat},{$total},{$cash},'{$date}',(SELECT MAX(ID) FROM transaction_details))");

              // header('location:posdetails.php');

            ?>
<!--  <script type="text/javascript">
      alert("Transaction successfully added.");
      window.location = "pos.php";
      </script> -->