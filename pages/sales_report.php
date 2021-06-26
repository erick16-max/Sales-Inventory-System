<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
?><?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
            ?>
  
<div class="row">
  <div class="col-md-6">
    
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel">
      <div class="panel-heading">

      </div>
      <div class="container">
          <form class="clearfix" method="post" action="sales_report_process1.php">
            <div class="form-group">
              <label class="form-label" style="font-weight: 700;">Date Range</h3></label>
              <div class="row">
              <div class="form-group " style="margin-right: 20px;">
                <input placeholder="Date From:" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date" name="start-date" class="form-control" required/>
              </div>
              <div class="form-group">
                <input placeholder="Date To:" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="end-date" name="end-date" class="form-control" required/>
              </div>
            </div>
            </div>
           
            <div class="form-group ">
                 <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
           
          </form>
      </div>

    </div>
  </div>

</div>          
            
<?php
include '../includes/footer.php';
?>