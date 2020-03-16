<?php 
  $db  = new crud;
  $cat = new categories($db->dbconn());
  if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(!empty($_POST['pro_name']) && 
     !empty($_POST['pro_price']) &&
     !empty($_POST['pro_dsc']) &&
     !empty($_POST['cat_id']) &&
     !empty($_POST['pro_qty']) &&
     !empty($_FILES['pro_img'])
     )
     {
        $pro = new products($db->dbconn());
        $pro-> addProData($_POST['pro_name'],
                          $_POST['pro_price'],
                          $_POST['pro_dsc'],
                          $_POST['cat_id'],
                          $_POST['pro_qty']);
        header('location:admin.php?products');
     }


}
?>
<form action = "" method = "POST" enctype = "multipart/form-data">
<h2 style="margin-top: 20px"> Add Products</h2>

  <table class = "table table-hover" style="margin-top: 20px">
    <tr>
      <td>
        <label>Products Name:</label>
      </td>
      <td>
        <input type = "text" name = "pro_name" class = "form-control"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Products Price:</label>
      </td>
      <td>
        <input type = "number" min = "1"name = "pro_price" class = "form-control"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Products Description:</label>
      </td>
      <td>
        <textarea name = "pro_dsc" class = "form-control"></textarea>
      </td>
    </tr>
    <tr>
      <td>
        <label>Products Quantity:</label>
      </td>
      <td>
        <input type = "number" min = "1" name = "pro_qty" class = "form-control"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Categories Name:</label>
      </td>
      <td>
          <select name="cat_id" class = "form-control"> 
          <?php $cat->getCatNameCatId(); ?>
          </select>

    </td>
    </tr>
    <tr>  
      <td>
        <label>Categorie Image:</label>
      </td>
      <td>
        <input type = "file" name = "pro_img[]" multiple MAX_FILE_SIZE = "30000" class = "form-control"/>
      </td>
    </tr>
    <tr>
      <td colspan = "2">
        <center>
          <input type = "submit" name = "add" class = "btn btn-primary form-control" value = "Add"/>
        <center/>
      </td>
    </tr>
  </table>
</form>