<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
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
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Category&nbsp;<a  href="#" data-toggle="modal" data-target="#categoryMODAL" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Category Id</th>
                        <th>Categoty Name</th>
                       
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM category';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['CATEGORY_ID'].'</td>';
                      echo '<td>'. $row['CNAME'].'</td>';
                     
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


 <!-- Modal -->
 <div class="modal fade" id="categoryMODAL" tabindex="-1" role="dialog" aria-labelledby="POS" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Category Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="category_add.php" method="POST">
                  <div class="form-group row text-left mb-2">
                    <div class="col-sm-12 mb-2">
                     
                          <input class="form-control text-right" id="txtNumber"  type="text" name="category" placeholder="Enter Category Name"  required>
                    </div>
                  </div>
              
              <div class="modal-footer">
                <button name="submit" type="submit" class="btn btn-primary btn-block">Add Category</button>
              </div>
            </div>
            </form>
          </div>

        </div>
        <!-- END OF Modal -->

       
<?php
include '../includes/footer.php';
?>