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
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $category = $_POST['category'];
             
        
                if (isset($_POST['submit'])){
                    $query = "INSERT INTO category
                    (CATEGORY_ID, CNAME)
                    VALUES (Null,'{$category}')";
                    mysqli_query($db,$query)or die (mysqli_error($db));
             
                    }
            ?>
              <script type="text/javascript">
                window.location = "category.php";
              </script>
          </div>

<?php
include '../includes/footer.php';
?>