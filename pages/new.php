

<td align="right"> <div class="btn-group">
<a type="button" class="btn btn-primary bg-gradient-primary" href="pro_searchfrm.php?action=edit & id='.$row['PRODUCT_CODE'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
<div class="btn-group">
<a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
... <span class="caret"></span></a>
<ul class="dropdown-menu text-center" role="menu">
  <li>
    <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pro_edit.php?action=edit & id='.$row['PRODUCT_ID']. '">
      <i class="fas fa-fw fa-edit"></i> Edit
    </a>
  </li>
  <li>
    <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="pro_del.php?action=delete & id='.$row['PRODUCT_ID']. '">
      <i class="fas fa-fw fa-trash"></i> Delete
    </a>
  </li>
</ul>
</div>
</div> </td>;
</tr> ;
                      
         